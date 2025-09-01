@extends('Backend.admin.master')

@section('title' , 'View Employees')

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
                    <h4 class="page-title">View Employees</h4>
                </div>
                <div class="text-right col-sm-8 col-9 m-b-20">
                    <a href="{{ Route('add_employee') }}" class="float-right btn btn-primary btn-rounded" style="font-weight: bold;"><i class="fa fa-plus"></i> Add Employee</a>
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
                            <option value="name">Employee Name</option>
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
                                    <th>Employee Name</th>
                                    <th>Department Name</th>
                                    <th>Job Title</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="employees_table_body">
                                @if($employees->count() > 0)
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td>{{ $employee->id }}</td>
                                            <td>{{ $employee->user->name }}</td>
                                            <td>{{ $employee->department->name }}</td>
                                            <td>{{ $employee->jobTitles->pluck('name')->implode(' , ') }}</td>
                                            <td>{{ $employee->user->email }}</td>
                                            <td>{{ $employee->user->phone }}</td>
                                            <td>
                                                @if($employee->status === 'active')
                                                    <span class="status-badge" style="padding: 6px 24px; font-size: 18px; border-radius: 50px; background-color: #13ee29; color: white;">Active</span>
                                                @else
                                                    <span class="status-badge" style="padding: 6px 20px; font-size: 18px; border-radius: 50px; background-color: #f90d25; color: white;">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="action-btns">
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('profile_employee', ['id' => $employee->id]) }}" class="mr-1 btn btn-outline-success btn-sm"><i class="fa fa-eye"></i></a>
                                                    <a href="{{ route('edit_employee', ['id' => $employee->id]) }}" class="mr-1 btn btn-outline-primary btn-sm"><i class="fa fa-edit"></i></a>
                                                    <button class="btn btn-outline-danger btn-sm delete-employee" data-id="{{ $employee->id }}"><i class="fa fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            <div style="font-weight: bold; font-size: 18px; margin-top:15px;">
                                                No Employees Available At The Moment
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div id="employees-pagination" class="pagination-wrapper d-flex justify-content-center">
                            {{ $employees->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
<script>
    $(document).on('click', '.delete-employee', function () {
        let employeeId = $(this).data('id');
        let url = `/admin/delete/employee/${employeeId}`;

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
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'Employee Has Been Deleted Successfully',
                                icon: 'success'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error!', 'Something went wrong.', 'error');
                        }
                    },
                });
            }
        });
    });

    // ✅ البحث Ajax
    let lastKeyword = '';

    function fetchEmployees(url = "{{ route('search_employees') }}") {
        let keyword = $('#search_input').val().trim();
        let filter  = $('#search_filter').val();

        if (keyword === '' && lastKeyword === '') return;

        if (keyword === '' && lastKeyword !== '') {
            lastKeyword = '';
            window.location.href = "{{ route('view_employees') }}";
            return;
        }

        lastKeyword = keyword;

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            data: { keyword: keyword, filter: filter },
            success: function (response) {
                $('#employees_table_body').html(response.html);
                if (response.searching) {
                    if (response.count > 12) {
                        $('#employees-pagination').html(response.pagination).show();
                    } else {
                        $('#employees-pagination').empty().hide();
                    }
                } else {
                    $('#employees-pagination').show();
                }
            },
            error: function () {
                console.error("Failed to fetch employees.");
            }
        });
    }

    $(document).on('input', '#search_input', function () { fetchEmployees(); });
    $(document).on('change', '#search_filter', function () { fetchEmployees(); });

    $(document).on('click', '#employees-pagination .page-link', function (e) {
        let keyword = $('#search_input').val().trim();
        if (keyword !== '') {
            e.preventDefault();
            let url = $(this).attr('href');
            if (url && url !== '#') fetchEmployees(url);
        }
    });
</script>
@endsection
