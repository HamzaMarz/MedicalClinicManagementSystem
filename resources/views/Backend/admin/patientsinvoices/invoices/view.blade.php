@extends('Backend.admin.master')

@section('title' , 'View Patients Invoices')


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

    .table-responsive {
        overflow-x: auto;
        scrollbar-width: none; /* لإخفاء الشريط في فايرفوكس */
    }

    .table-responsive::-webkit-scrollbar {
        display: none; /* لإخفاء الشريط في كروم */
    }

</style>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">View Patients Invoices</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    
                    <div class="row mb-4">
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
                                <option value="appointment_id">Appointment ID</option>
                                <option value="patient_name">Patient Name</option>
                                <option value="status">Status</option>
                              </select>
                            </div>
                        </div>
                    </div>
                    <table class="table mb-0 text-center table-bordered table-striped custom-table">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Appointment ID</th>
                                <th>Patient Name</th>
                                <th>Final Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="appointments_table_body">
                            @if($patients_invoices->count() > 0)
                                @foreach ($patients_invoices as $patient_invoice)
                                    <tr>
                                        <td>{{ $patient_invoice->id }}</td>
                                        <td>{{ $patient_invoice->appointment->id }}</td>
                                        <td>{{ $patient_invoice->appointment->patient->user->name }}</td>
                                        <td>${{ $patient_invoice->final_amount }}</td>
                                        <td>
                                            @php
                                                $amount_paid = $patient_invoice->payments->sum(function($payment) {
                                                    return $payment->patientInvoicePaymentDetails->sum('amount_paid');
                                                });
                                            @endphp

                                            @if($amount_paid == 0)
                                                <span class="status-badge" style="min-width: 140px; display: inline-block; text-align: center; padding: 4px 12px; font-size: 18px; border-radius: 50px; background-color: #f90d25; color: white;">
                                                    unpaid
                                                </span>
                                            @elseif($amount_paid < $patient_invoice->final_amount)
                                                <span class="status-badge" style="min-width: 140px; display: inline-block; text-align: center; padding: 4px 12px; font-size: 18px; border-radius: 50px; background-color: #189de4; color: white;">
                                                    partial
                                                </span>
                                            @elseif($amount_paid == $patient_invoice->final_amount)
                                                <span class="status-badge" style="min-width: 140px; display: inline-block; text-align: center; padding: 4px 12px; font-size: 18px; border-radius: 50px; background-color: #15ef70; color: white;">
                                                    paid
                                                </span>
                                            @elseif($amount_paid > $patient_invoice->final_amount)
                                                <span class="status-badge" style="min-width: 140px; display: inline-block; text-align: center; padding: 4px 12px; font-size: 18px; border-radius: 50px; background-color: #9b59b6; color: white;">
                                                    overpaid
                                                </span>
                                            @endif
                                        </td>
                                        <td class="action-btns">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('details_patient_invoice', ['id' => $patient_invoice->id]) }}" class="mr-1 btn btn-outline-success btn-sm"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('edit_patient_invoice', ['id' => $patient_invoice->id]) }}" class="mr-1 btn btn-outline-primary btn-sm"><i class="fa fa-edit"></i></a>
                                                <button class="btn btn-outline-danger btn-sm delete-patientInvoice" data-id="{{ $patient_invoice->id }}"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="text-center">
                                        <div  style="font-weight: bold; font-size: 18px; margin-top:15px;">
                                            No Patients Invoices Available At The Moment
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="mb-3 d-flex justify-content-end" style="margin-top: 25px;">
                        <a href="{{ Route('dashboard') }}" class="btn btn-primary rounded-pill" style="font-weight: bold;">
                            Back
                        </a>
                    </div>
                    <div id="main-pagination" class="pagination-wrapper d-flex justify-content-center">
                        {{ $patients_invoices->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')
<script>
    $(document).on('click', '.delete-patientInvoice', function () {
        let patientInvoiceId = $(this).data('id');
        let url = `/admin/delete/patient/invoice/${patientInvoiceId}`;

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
                                text: 'Patient Invoice Has Been Deleted Successfully',
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

    $(document).ready(function () {

        let lastKeyword = '';

        function fetchInvoices(url = "{{ route('search_patients_invoices') }}") {
            let keyword = $('#search_input').val().trim();
            let filter  = $('#search_filter').val();

            if (keyword === lastKeyword) return;
            lastKeyword = keyword;

            $.ajax({
                url: url,
                type: 'GET',
                data: { keyword: keyword, filter: filter },
                dataType: 'json',
                success: function (response) {
                    $('#invoices_table_body').html(response.html);

                    if (response.searching) {
                        if (response.count > 12) {
                            $('.pagination-wrapper').html(response.pagination).show();
                        } else {
                            $('.pagination-wrapper').empty().hide();
                        }
                    } else {
                        $('.pagination-wrapper').show();
                    }
                },
                error: function () {
                    console.error("Error while fetching invoices.");
                }
            });
        }

        $(document).on('input', '#search_input', function () {
            fetchInvoices();
        });

        $(document).on('change', '#search_filter', function () {
            fetchInvoices();
        });

        $(document).on('click', '.pagination-wrapper .page-link', function (e) {
            let keyword = $('#search_input').val().trim();
            if (keyword !== '') {
                e.preventDefault();
                let url = $(this).attr('href');
                if (url && url !== '#') {
                    fetchInvoices(url);
                }
            }
        });
    });

</script>
@endsection
