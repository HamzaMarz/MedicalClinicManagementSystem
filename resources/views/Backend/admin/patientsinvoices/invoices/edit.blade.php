@extends('Backend.admin.master')

@section('title' , 'Edit Patient Invoice')

@section('content')
<style>
    .col-sm-6 { margin-bottom: 20px; }
    input[type="date"] { direction: ltr; text-align: left; }
    .card { border: 1px solid #ddd !important; border-radius: 8px !important; box-shadow: 0 4px 10px rgba(0,0,0,0.08) !important; overflow: hidden !important; }
    .card-header { background-color: #00A8FF !important; color: #fff !important; font-weight: 600 !important; padding: 12px 15px !important; font-size: 16px !important; border-bottom: 1px solid #ddd !important; }
    .card-body { background-color: #fff; padding: 20px; }
    .small-gutter > [class^="col-"] {
        padding-left: 30px !important;
        margin-top: 15px !important;
    }
</style>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title" style="margin-bottom:30px;">Edit Patient Invoice</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form method="POST" action="{{ route('update_patient_invoice', ['id' => $patient_invoice->id]) }}">
                    @csrf
                    @method('PUT')

                    <div class="card">
                        <div class="card-header">Invoice Information</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Appointment ID <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar-check"></i></span>
                                        </div>
                                        <input type="number" class="form-control" id="appointment_id" name="appointment_id" value="{{ $patient_invoice->appointment_id }}">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label>Patient Name <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user-injured"></i></span>
                                        </div>
                                        <select class="form-control" id="patient_id" name="patient_id" required>
                                            <option value="" disabled hidden>Select Patient</option>
                                            @php
                                                $selectedPatientId = old('patient_id', $patient_invoice->patient_id ?? null);
                                            @endphp
                                            @foreach($patients as $patient)
                                                <option value="{{ $patient->id }}" {{ $patient->id == $selectedPatientId ? 'selected' : '' }}>
                                                    {{ $patient->user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label>Discount <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-percentage"></i></span>
                                        </div>
                                        <input type="number" class="form-control" id="discount" name="discount" value="{{ $patient_invoice->discount }}">
                                    </div>
                                </div>

                                {{-- <div class="col-sm-6">
                                    <label class="display-block">Payment Status <span class="text-danger">*</span></label>
                                    @php
                                        $status = old('status', $patient_invoice->status ?? 'unpaid');
                                    @endphp
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="status_paid" value="paid" {{ $status === 'paid' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status_paid">Paid</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="status_unpaid" value="unpaid" {{ $status === 'unpaid' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status_unpaid">Unpaid</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="status_partial" value="partial" {{ $status === 'partial' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status_partial">Partial</label>
                                    </div>
                                </div> --}}

                                <div class="col-sm-12">
                                    <label>Notes</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="3" cols="30">{{ $patient_invoice->notes }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center m-t-20">
                        <button type="submit" class="btn btn-primary submit-btn editBtn" style="text-transform: none !important;">Edit Patient Invoice</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection



@section('js')
    <script>
        function isValidSelectValue(selectId) {
            let val = $(`#${selectId}`).val();
            return val !== '' && val !== null && val !== undefined && $(`#${selectId} option[value="${val}"]`).length > 0;
        }

        $(document).ready(function () {
            $('.editBtn').click(function (e) {
                e.preventDefault();

                let appointment_id = $('#appointment_id').val().trim();
                let patient_id = $('#patient_id').val();
                let discount = $('#discount').val().trim();
                // let status = $('input[name="status"]:checked').val();
                let notes = $('#notes').val().trim();

                let formData = new FormData();
                formData.append('_method', 'PUT');
                formData.append('appointment_id', appointment_id);
                formData.append('patient_id', patient_id);
                formData.append('discount', discount);
                // formData.append('status', status);
                formData.append('notes', notes);

                if (appointment_id === '' || !isValidSelectValue('patient_id') || discount === '') {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Please Enter All Required Fields',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                $.ajax({
                    method: 'POST',
                    url: "{{ route('update_patient_invoice', ['id' => $patient_invoice->id]) }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.data == 0) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'The Patient Invoice Has Already Been Booked',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }else if (response.data == 1) {
                            Swal.fire({
                                title: 'Success',
                                text: 'Patient Invoice Has Been Updated Successfully',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.href = '/admin/view/patients/invoices';
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection
