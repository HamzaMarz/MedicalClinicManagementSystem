@extends('Backend.admin.master')

@section('title' , 'View Insurance Providers')

@section('content')
<style>
    html, body { height: 100%; margin: 0; }
    .page-wrapper { min-height: 100vh; display: flex; flex-direction: column; }
    .content { flex: 1; display: flex; flex-direction: column; }
    .pagination-wrapper { margin-top: auto; padding-top: 80px; padding-bottom: 30px; }
</style>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">View Insurance Providers</h4>
            </div>
            <div class="text-right col-sm-8 col-9 m-b-20">
                <a href="{{ Route('add_insurance_provider') }}" class="float-right btn btn-primary btn-rounded" style="font-weight: bold;">
                    <i class="fa fa-plus"></i> Add Insurance Provider
                </a>
            </div>
        </div>

        {{-- 🔍 البحث --}}
        <div class="mb-4 row">
            <div class="col-md-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                    </div>
                    <input type="text" id="search_input" name="keyword" class="form-control" placeholder="Search...">
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Search by:</span>
                    </div>
                    <select id="search_filter" name="filter" class="form-control">
                        <option value="name">Name</option>
                        <option value="representative_name">Representative Name</option>
                        <option value="status">Status</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- 📋 الجدول --}}
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table mb-0 text-center table-bordered table-striped custom-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Provider Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Representative Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="insurance_table_body">
                            @include('Backend.admin.insurances.search', ['insurances_providers' => $insurances_providers])
                        </tbody>
                    </table>

                    <div id="insurance-pagination" class="pagination-wrapper d-flex justify-content-center">
                        {{ $insurances_providers->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')
<script>
    // 🗑️ حذف مزود
    $(document).on('click', '.delete-insurance-provider', function () {
        let insuranceProviderId = $(this).data('id');
        let url = `/admin/delete/insurance-provider/${insuranceProviderId}`;

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
                            Swal.fire({ title: 'Deleted!', text: 'Insurance Provider deleted successfully', icon: 'success' })
                                .then(() => { location.reload(); });
                        } else {
                            Swal.fire('Error!', 'Something went wrong.', 'error');
                        }
                    },
                });
            }
        });
    });

    // 🔍 البحث Ajax
    let lastKeyword = '';

    function fetchInsuranceProviders(url = "{{ route('search_insurances_providers') }}") {
        let keyword = $('#search_input').val().trim();
        let filter  = $('#search_filter').val();

        if (keyword === '' && lastKeyword === '') return;

        if (keyword === '' && lastKeyword !== '') {
            lastKeyword = '';
            window.location.href = "{{ route('view_insurances_providers') }}";
            return;
        }

        lastKeyword = keyword;

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            data: { keyword: keyword, filter: filter },
            success: function (response) {
                $('#insurance_table_body').html(response.html);
                if (response.searching) {
                    if (response.count > 12) {
                        $('#insurance-pagination').html(response.pagination).show();
                    } else {
                        $('#insurance-pagination').empty().hide();
                    }
                } else {
                    $('#insurance-pagination').show();
                }
            },
            error: function () {
                console.error("Failed to fetch insurance providers.");
            }
        });
    }

    $(document).on('input', '#search_input', function () { fetchInsuranceProviders(); });
    $(document).on('change', '#search_filter', function () { fetchInsuranceProviders(); });

    $(document).on('click', '#insurance-pagination .page-link', function (e) {
        let keyword = $('#search_input').val().trim();
        if (keyword !== '') {
            e.preventDefault();
            let url = $(this).attr('href');
            if (url && url !== '#') fetchInsuranceProviders(url);
        }
    });
</script>
@endsection
