@extends('Backend.employees.store_supervisors.master')

@section('title' , 'View Requests')

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
            padding-top: 80px; /* مسافة من الجدول */
            padding-bottom: 30px;
        }

    </style>

    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-4 col-3">
                    <h4 class="page-title">View Requests</h4>
                </div>
                {{-- <div class="text-right col-sm-8 col-9 m-b-20">
                    <a href="{{ Route('add_employee') }}" class="float-right btn btn-primary btn-rounded" style="font-weight: bold;"><i class="fa fa-plus"></i> Add Employee</a>
                </div> --}}
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
                            <option value="department">Department Name</option>
                            <option value="job_title">Job Title</option>
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
                                    <th>id</th>
                                    <th>Medication Name</th>
                                    <th>requested_quantity</th>
                                    <th>Sent by</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="employees_table_body">
                                @if($requests->count() > 0)
                                    @foreach ($requests as $request)
                                        <tr>
                                            <td>{{ $request->id }}</td>
                                            <td>{{ $request->medication->name }}</td>
                                            <td>{{ $request->requested_quantity }}</td>
                                            <td>Admin</td>
                                            <td>
                                                @if($request->status === 'pending')
                                                    <span class="status-badge" style="padding: 6px 24px; font-size: 18px; border-radius: 50px; background-color: #f5a623; color: white;">
                                                        Pending
                                                    </span>
                                                @elseif($request->status === 'approved')
                                                    <span class="status-badge" style="padding: 6px 24px; font-size: 18px; border-radius: 50px; background-color: #13ee29; color: white;">
                                                        Approved
                                                    </span>
                                                @elseif($request->status === 'rejected')
                                                    <span class="status-badge" style="padding: 6px 24px; font-size: 18px; border-radius: 50px; background-color: #f90d25; color: white;">
                                                        Rejected
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="action-btns">
                                                <div class="d-flex justify-content-center">
                                                    @if($request->status === 'pending')
                                                        {{-- زر الموافقة --}}
                                                        <button class="mr-2 btn btn-outline-success btn-sm btn-approve"
                                                            data-url="{{ route('medication_request_approve', ['id' => $request->id]) }}">
                                                            <i class="fa fa-check-circle"></i>
                                                        </button>
                                                
                                                        {{-- زر الرفض --}}
                                                        <a href="{{ route('view_reject', ['id' => $request->id]) }}"
                                                            class="btn btn-outline-danger btn-sm">
                                                            <i class="fa fa-times-circle"></i>
                                                        </a>
                                                    @else
                                                    <a href="{{ route('request_description', ['id' => $request->id]) }}"
                                                        class="btn btn-outline-primary btn-sm">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            <div style="font-weight: bold; font-size: 18px; margin-top:15px;">
                                                No Request Available At The Moment
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div id="employees-pagination" class="pagination-wrapper d-flex justify-content-center">
                            {{ $requests->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
<script>
    $(document).ready(function () {

        // Approve button
        $('.btn-approve').on('click', function (e) {
            e.preventDefault();

            let url = $(this).data('url');

            $.ajax({
                method: 'POST',
                url: url,
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.data == -1) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'The Request Status Cannot Be Changed',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    } else if (response.data == 0) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'The Mdication Is Not Available In The Store',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    } else if (response.data == 1) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'The Requested Quantity Is Not Available',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    } else if (response.data == 2) {
                        Swal.fire({
                            title: 'Success',
                            text: 'The Request Has Been Approved And Processed Successfully',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => location.reload());
                    }
                }
            });
        });

    });
</script>
@endsection
