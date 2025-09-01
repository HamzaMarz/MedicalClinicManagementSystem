@extends('Backend.admin.master')

@section('title' , 'View Trashed Medications')

@section('content')

<style>
    html, body {
        height: 100%;
        margin: 0;
    }

    .page-wrapper {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .content {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .pagination-wrapper {
        margin-top: auto;
        padding-top: 80px;
        padding-bottom: 30px;
    }
</style>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">View Trashed Medications</h4>
            </div>
        </div>
        <div class="mb-4 row">
            <div class="text-right col-sm-12">
                <button class="btn btn-danger btn-rounded delete-all-medications" style="font-weight: bold;">
                    <i class="fa fa-trash"></i> Remove All
                </button>

                <a href="{{ Route('view_medications') }}" class="btn btn-primary btn-rounded" style="font-weight: bold;">
                    View Medications
                </a>
            </div>
        </div>

        <div class="mb-4 row">
            <div class="col-md-4">
                <input type="text" id="search_input" name="keyword" class="form-control" placeholder="Search...">
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Search by:</span>
                    </div>
                    <select id="search_filter" name="filter" class="form-control">
                        <option value="name">Medication Name</option>
                        <option value="dosage_form">Dosage Form</option>
                        <option value="category">Category</option>
                        <option value="status">Status</option>
                    </select>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table mb-0 text-center table-bordered table-striped custom-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Medication Name</th>
                                <th>Dosage Form</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="trashed_medications_table_body">
                            @include('Backend.admin.medications.trashed.searchTrashedMedication', ['medications' => $medications])
                        </tbody>
                    </table>

                    <div id="medications-pagination" class="pagination-wrapper d-flex justify-content-center">
                        {{ $medications->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')
<script>
    $(document).on('click', '.restore-medication', function () {
        let medicationId = $(this).data('id');
        let url = `/admin/restore/medication/${medicationId}`;

        Swal.fire({
            title: 'Are you sure?',
            text: "This will restore the medication",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, restore it'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire('Restored!', 'Medication has been restored.', 'success')
                                .then(() => { location.reload(); });
                        } else {
                            Swal.fire('Error!', 'Something went wrong.', 'error');
                        }
                    },
                    error: function () {
                        Swal.fire('Error!', 'Request failed.', 'error');
                    }
                });
            }
        });
    });

    $(document).on('click', '.delete-medication', function () {
        let medicationId = $(this).data('id');
        let url = `/admin/medication/force-delete/${medicationId}`;

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            imageUrl: 'https://img.icons8.com/ios-filled/50/fa314a/delete-trash.png',
            imageWidth: 60,
            imageHeight: 60,
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'Medication Has Been Deleted Successfully',
                                icon: 'success'
                            }).then(() => { location.reload(); });
                        } else {
                            Swal.fire('Error!', 'Something went wrong.', 'error');
                        }
                    },
                });
            }
        });
    });

    $(document).on('click', '.delete-all-medications', function () {
        Swal.fire({
            title: 'Are you sure?',
            text: "All medications in the trash will be permanently deleted.",
            imageUrl: 'https://img.icons8.com/ios-filled/50/fa314a/delete-trash.png',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete all'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('force_delete_all_medications') }}",
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire('Deleted!', 'All trashed medications have been deleted permanently.', 'success')
                                .then(() => { location.reload(); });
                        } else {
                            Swal.fire('Error!', 'Something went wrong.', 'error');
                        }
                    },
                    error: function () {
                        Swal.fire('Error!', 'Request failed.', 'error');
                    }
                });
            }
        });
    });

    // ✅ البحث Ajax
    let lastKeyword = '';

    function fetchMedications(url = "{{ route('search_trashed_medications') }}") {
        let keyword = $('#search_input').val().trim();
        let filter  = $('#search_filter').val();

        if (keyword === '' && lastKeyword === '') return;

        if (keyword === '' && lastKeyword !== '') {
            lastKeyword = '';
            window.location.href = "{{ route('view_trashed_medications') }}";
            return;
        }

        lastKeyword = keyword;

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            data: { keyword: keyword, filter: filter },
            success: function (response) {
                $('#trashed_medications_table_body').html(response.html);
                if (response.searching) {
                    if (response.count > 12) {
                        $('#medications-pagination').html(response.pagination).show();
                    } else {
                        $('#medications-pagination').empty().hide();
                    }
                } else {
                    $('#medications-pagination').show();
                }
            },
            error: function () {
                console.error("Failed to fetch medications.");
            }
        });
    }

    $(document).on('input', '#search_input', function () { fetchMedications(); });
    $(document).on('change', '#search_filter', function () { fetchMedications(); });

    $(document).on('click', '#medications-pagination .page-link', function (e) {
        let keyword = $('#search_input').val().trim();
        if (keyword !== '') {
            e.preventDefault();
            let url = $(this).attr('href');
            if (url && url !== '#') fetchMedications(url);
        }
    });
</script>
@endsection
