@extends('Backend.admin.master')

@section('title' , 'View Prescriptions')

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
                    <h4 class="page-title">View Prescriptions</h4>
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
                        <option value="patient_name">Patient Name</option>
                        <option value="department">Department</option>
                        <option value="doctor_name">Doctor Name</option>
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
                                    <th>Appointment_ID</th>
                                    <th>Patient Name</th>
                                    <th>Department</th>
                                    <th>Doctor Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($prescriptions->count() > 0)
                                    @foreach ($prescriptions as $prescription)
                                        <tr>
                                            <td>{{ $prescription->id }}</td>
                                            <td>#APP_{{ $prescription->appointment->id }}</td>
                                            <td>{{ $prescription->patient->user->name }}</td>
                                            <td>{{ $prescription->appointment->department->name }}</td>
                                            <td>{{ $prescription->doctor->employee->user->name }}</td>
                                            <td class="action-btns">
                                                <div class="d-flex justify-content-center">
                                                    <!-- زر العرض -->
                                                    <a href="{{ route('view_items_prescription', ['id' => $prescription->id]) }}"
                                                       class="mr-1 btn btn-outline-success btn-sm">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <!-- زر الحذف -->
                                                    <button class="btn btn-outline-danger btn-sm delete-prescription"
                                                            data-id="{{ $prescription->id }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="p-4 text-center">
                                            <strong style="font-size: 18px; color: gray;">No Prescriptions Found</strong>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="pagination-wrapper d-flex justify-content-center">
                            {{ $prescriptions->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        $(document).on('click', '.delete-prescription', function () {
            let prescriptionId = $(this).data('id');
            let url = `/admin/delete/prescription/${prescriptionId}`;

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
                                    text: 'Prescription Has Been Deleted Successfully',
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


        let lastKeyword = '';

        function fetchPrescriptions(url = "{{ route('search_prescriptions') }}") {
            let keyword = $('#search_input').val().trim();
            let filter  = $('#search_filter').val();

            if (keyword === lastKeyword) {
                return;
            }
            lastKeyword = keyword;

            $.ajax({
                url: url,
                type: 'GET',
                data: { keyword: keyword, filter: filter },
                dataType: 'json',
                success: function (response) {
                    $('tbody').html(response.html);

                    if (response.searching) {
                        if (response.count > 10) {
                            $('.pagination-wrapper').html(response.pagination).show();
                        } else {
                            $('.pagination-wrapper').empty().hide();
                        }
                    } else {
                        $('.pagination-wrapper').show();
                    }
                },
                error: function () {
                    console.error("Error while fetching prescriptions.");
                }
            });
        }

        // البحث أثناء الكتابة
        $(document).on('input', '#search_input', function () {
            fetchPrescriptions();
        });

        // البحث عند تغيير الفلتر
        $(document).on('change', '#search_filter', function () {
            fetchPrescriptions();
        });

        // دعم الباجينيشن في حالة البحث
        $(document).on('click', '.pagination-wrapper .page-link', function (e) {
            let keyword = $('#search_input').val().trim();
            if (keyword !== '') {
                e.preventDefault();
                let url = $(this).attr('href');
                if (url && url !== '#') {
                    fetchPrescriptions(url);
                }
            }
        });

    </script>
@endsection
