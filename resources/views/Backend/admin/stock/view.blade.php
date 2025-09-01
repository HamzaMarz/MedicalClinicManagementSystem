@extends('Backend.admin.master')

@section('title' , 'View Stock Inventory')

@section('content')
<style>
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
                <h4 class="page-title">View Stock Inventory</h4>
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
                        <option value="name">Medicine Name</option>
                        <option value="quantity">Quantity</option>
                        <option value="batch_number">Batch Number</option>
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
                                <th>Medicine Name</th>
                                <th>Quantity</th>
                                <th>Batch Number</th>
                                <th>Remaining Quantity</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="medications_table_body">
                            @if($medicineStock->count() > 0)
                                @foreach ($medicineStock as $med)
                                    <tr>
                                        <td>{{ $med->id }}</td>
                                        <td>{{ $med->medication->name }}</td>
                                        <td>{{ $med->quantity }}</td>
                                        <td>{{ $med->batch_number }}</td>
                                        <td>{{ $med->remaining_quantity }}</td>
                                        <td>
                                            @if($med->medication->status === 'Valid')
                                                <span class="status-badge" style="padding: 6px 24px; font-size: 18px; border-radius: 50px; background-color: #13ee29; color: white;">Valid</span>
                                            @else
                                                <span class="status-badge" style="padding: 6px 20px; font-size: 18px; border-radius: 50px; background-color: #f90d25; color: white;">Expired</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('description_medication', $med->id) }}" class="mr-1 btn btn-outline-success btn-sm"><i class="fa fa-eye"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="p-4 text-center">
                                        <strong style="font-size: 18px; color: gray;">No Medication Available At The Moment</strong>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    <div id="medications-pagination" class="pagination-wrapper d-flex justify-content-center">
                        {{ $medicineStock->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')
    <script>
        let lastKeyword = '';

        function fetchMedications(url = "{{ route('search_pharmacy_inventory') }}") {
            let keyword = $('#search_input').val().trim();
            let filter  = $('#search_filter').val();

            if (keyword === '' && lastKeyword === '') return;
            if (keyword === '' && lastKeyword !== '') {
                lastKeyword = '';
                window.location.href = "{{ route('view_pharmacy_inventory') }}";
                return;
            }

            lastKeyword = keyword;

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                data: { keyword: keyword, filter: filter },
                success: function (response) {
                    $('#medications_table_body').html(response.html);
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
