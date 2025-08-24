@extends('Backend.master')

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
        @if ($departmentsManagers->count() > 0)
            <div class="row doctor-grid" >
                @foreach ($departmentsManagers as $departmentsManager)
                    <div class="col-md-4 col-sm-4 col-lg-3">
                        <div class="profile-widget">
                            <div class="doctor-img">
                                <a class="avatar" href="{{ Route('profile_department_manager' , ['id' => $departmentsManager->id]) }}">
                                    <img src="{{ asset($departmentsManager->user->image ?? 'assets/img/user.jpg') }}">   
                                </a>
                            </div>
                            <div class="dropdown profile-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ Route('edit_department_manager' , ['id' => $departmentsManager->id]) }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item delete-department-manager" data-id="{{ $departmentsManager->id }}" href="{{ Route('delete_department_manager' , ['id' => $departmentsManager->id]) }}" data-toggle="modal" data-target="#delete_doctor"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>
                            <h4 class="doctor-name text-ellipsis"><a href="{{ Route('profile_department_manager' , ['id' => $departmentsManager->id]) }}">{{ $departmentsManager->employee->user->name }}</a></h4>
                            <div class="doc-prof">{{ $departmentsManager->employee->department->name }}</div>
                            <div class="user-country">
                                <i class="fa fa-map-marker"></i> {{ $departmentsManager->employee->user->address }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pagination-wrapper d-flex justify-content-center">
                {{ $departmentsManagers->links('pagination::bootstrap-4') }}
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
</script>
@endsection



