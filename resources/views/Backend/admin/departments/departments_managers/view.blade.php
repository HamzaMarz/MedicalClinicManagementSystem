@extends('Backend.admin.master')

@section('title' , 'View Department Manager')

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
                <h4 class="page-title">View Department Manager</h4>
            </div>
        </div>
        <div class="mb-4 row">
            <div class="col-md-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-search"></i>
                        </span>
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
                        <option value="name">Manager Name</option>
                    </select>
                </div>
            </div>
        </div>

        @if ($departments_managers->count() > 0)
            <div class="row doctor-grid" id="department_manager_container">
                @foreach ($departments_managers as $department_manager)
                    <div class="col-md-4 col-sm-4 col-lg-3">
                        <div class="profile-widget">
                            <div class="doctor-img">
                                <a class="avatar" href="{{ Route('profile_department_manager' , ['id' => $department_manager->id]) }}">
                                    <img src="{{ asset($department_manager->user->image ?? 'assets/img/user.jpg') }}">
                                </a>
                            </div>
                            <div class="dropdown profile-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ Route('edit_department_manager' , ['id' => $department_manager->id]) }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item delete-department-manager" data-id="{{ $department_manager->id }}" href="{{ Route('delete_department_manager' , ['id' => $department_manager->id]) }}" data-toggle="modal" data-target="#delete_doctor"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>
                            <h4 class="doctor-name text-ellipsis"><a href="{{ Route('profile_department_manager' , ['id' => $department_manager->id]) }}">{{ $department_manager->employee->user->name }}</a></h4>
                            <div class="doc-prof">{{ $department_manager->employee->department->name }}</div>
                            <div class="user-country">
                                <i class="fa fa-map-marker"></i> {{ $department_manager->employee->user->address }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pagination-wrapper d-flex justify-content-center" id="department_manager_pagination">
                {{ $departments_managers->links('pagination::bootstrap-4') }}
            </div>
        @else
            <div class="col-12 text-center">
                <div class="alert alert-info" style="font-weight: bold; font-size: 18px; margin-top:50px;">
                    No Departments Managers Available At The Moment
                </div>
            </div>
        @endif
    </div>
</div>
@endsection


@section('js')
<script>
    // حذف مدير القسم
    $(document).on('click', '.delete-department-manager', function () {
        let doctorId = $(this).data('id');
        let url = `/admin/delete/department-manager/${doctorId}`;

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
                                text: 'Department Manager Has Been Deleted Successfully',
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

    // البحث Ajax
    let lastKeyword = '';

    function fetchDepartmentManagers(url = "{{ route('search_departments_managers') }}") {
        let keyword = $('#search_input').val().trim();
        let filter  = $('#search_filter').val();

        // إذا نفس الكلمة ما تغيرت، ما نعمل طلب جديد
        if (keyword === lastKeyword) {
            return;
        }
        lastKeyword = keyword;

        $.ajax({
            url: url,
            type: 'GET',
            data: {
                keyword: keyword,
                filter: filter
            },
            dataType: 'json',
            success: function (response) {
                $('#department_manager_container').html(response.html);

                if (response.searching) {
                    if (response.count > 12) {
                        $('#department_manager_pagination').html(response.pagination).show();
                    } else {
                        $('#department_manager_pagination').empty().hide();
                    }
                } else {
                    $('#department_manager_pagination').show();
                }
            },
            error: function () {
                console.error("Error while fetching Department Managers.");
            }
        });
    }

    // البحث أثناء الكتابة
    $(document).on('input', '#search_input', function () {
        fetchDepartmentManagers();
    });

    // البحث عند تغيير الفلتر
    $(document).on('change', '#search_filter', function () {
        fetchDepartmentManagers();
    });

    // دعم الباجينيشن في حالة البحث
    $(document).on('click', '#department_manager_pagination .page-link', function (e) {
        let keyword = $('#search_input').val().trim();
        if (keyword !== '') {
            e.preventDefault();
            let url = $(this).attr('href');
            if (url && url !== '#') {
                fetchDepartmentManagers(url);
            }
        }
    });
</script>
@endsection
