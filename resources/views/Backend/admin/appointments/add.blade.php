@extends('Backend.admin.master')

@section('title' , 'Add New Appointment')

@section('content')

<style>
    .col-sm-6{ margin-bottom:20px; }
    input[type="date"]{ direction:ltr; text-align:left; }
    .card + .card{ margin-top:20px; }
    .card-header{ font-weight:600; }

    .card {
        border: 1px solid #ddd !important;
        border-radius: 8px !important;
        box-shadow: 0 4px 10px rgba(0,0,0,0.08) !important;
        overflow: hidden !important;
    }

    .card-header {
        background-color: #00A8FF !important;
        color: #fff !important;
        font-weight: 600 !important;
        padding: 12px 15px !important;
        font-size: 16px !important;
        border-bottom: 1px solid #ddd !important;
    }

    .card-body {
        background-color: #fff;
        padding: 20px;
    }
</style>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title" style="margin-bottom: 30px;">Add New Appointment</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form method="POST" action="{{ Route('store_appointment') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- Appointment Details --}}
                    <div class="card">
                        <div class="card-header">Appointment Details</div>
                        <div class="card-body">
                            <div class="row">

                                {{-- Patient --}}
                                <div class="col-sm-6">
                                    <label>Patient Name <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user-injured"></i></span>
                                        </div>
                                        <select class="form-control" id="patient_id" name="patient_id" required>
                                            <option value="" disabled selected hidden>Select Patient</option>
                                            @foreach($patients as $patient)
                                                <option value="{{ $patient->id }}">{{ $patient->user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- Department --}}
                                <div class="col-sm-6">
                                    <label>Department <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-stethoscope"></i></span>
                                        </div>
                                        <select class="form-control" id="department_id" name="department_id" required>
                                            <option value="" disabled selected hidden>Select Department</option>
                                            @foreach($departments as $department)
                                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- Doctor --}}
                                <div class="col-sm-6">
                                    <label>Doctor <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user-md"></i></span>
                                        </div>
                                        <select class="form-control" id="doctor_id" name="doctor_id" required>
                                            <option value="" disabled selected hidden>Select Doctor</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Day --}}
                                <div class="col-sm-6">
                                    <label>Appointment Day <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                        </div>
                                        <select name="appointment_day" id="appointment_day" class="form-control" required>
                                            <option value="" disabled selected hidden>Select Day</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Time --}}
                                <div class="col-sm-6">
                                    <label>Appointment Time <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                        </div>
                                        <select name="appointment_time" id="appointment_time" class="form-control" required>
                                            <option value="" disabled selected hidden>Select Appointment Time</option>
                                        </select>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    {{-- Notes --}}
                    <div class="card">
                        <div class="card-header">Notes</div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Notes</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3" cols="30"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="text-center m-t-20" style="margin-top:20px;">
                        <button type="submit" class="btn btn-primary submit-btn addBtn" style="text-transform:none !important;">
                            Add Appointment
                        </button>
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
            $('.addBtn').click(function (e) {
                e.preventDefault();

                let patient_id       = $('#patient_id').val();
                let department_id    = $('#department_id').val();
                let doctor_id        = $('#doctor_id').val();
                let appointment_time = $('#appointment_time').val();
                let appointment_day  = $('#appointment_day').val();
                let notes            = $('#notes').val() ? $('#notes').val().trim() : '';

                // ✅ FormData
                let formData = new FormData();
                formData.append('patient_id', patient_id);
                formData.append('department_id', department_id);
                formData.append('doctor_id', doctor_id);
                formData.append('appointment_time', appointment_time);
                formData.append('appointment_day', appointment_day);
                formData.append('notes', notes);

                // ✅ Validation قبل الإرسال
                if (!isValidSelectValue('patient_id') || !isValidSelectValue('department_id') ||
                    !isValidSelectValue('doctor_id') || !isValidSelectValue('appointment_time') ||
                    !isValidSelectValue('appointment_day'))
                {
                    Swal.fire('Error!', 'Please Enter All Required Fields', 'error');
                    return;
                }

                // ✅ Ajax Request
                $.ajax({
                    method: 'POST',
                    url: "{{ route('store_appointment') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.data == 0) {
                            Swal.fire('Error!', 'This patient already has an appointment at this time', 'error');
                        }
                        else if (response.data == 1) {
                            Swal.fire('Warning', 'This appointment slot is already booked. Please choose another time', 'warning');
                        }
                        else if (response.data == 2) {
                            Swal.fire('Error!', 'This appointment time has already passed. Please select another time', 'error');
                        }
                        else if (response.data == 3) {
                            Swal.fire('Success', 'Appointment Has Been Added Successfully', 'success')
                                .then(() => {
                                    window.location.href = '/admin/add/appointment';
                                });
                        }
                        else {
                            Swal.fire('Notice', 'Unexpected response, please try again', 'info');
                        }
                    }
                });
            });

            // عند اختيار القسم → جلب الأطباء
            $('#department_id').on('change', function () {
                let departmentId = $(this).val();

                if (departmentId) {
                    $.ajax({
                        url: '/admin/get-doctors-by-department/' + departmentId,
                        type: 'GET',
                        success: function (data) {
                            let doctorSelect = $('#doctor_id');
                            doctorSelect.empty().append('<option value="" disabled selected hidden>Select Doctor</option>');
                            $.each(data, function (key, doctor) {
                                doctorSelect.append('<option value="' + doctor.id + '">' + doctor.name + '</option>');
                            });
                        }
                    });
                }
            });

            // عند اختيار الطبيب → جلب أوقات العمل + الأيام
            $('#doctor_id').on('change', function () {
                let doctorId = $(this).val();

                if (doctorId) {
                    // 1) أوقات العمل
                    $.ajax({
                        url: '/admin/get-doctor-info/' + doctorId,
                        type: 'GET',
                        success: function (data) {
                            let startParts = data.work_start_time.split(':');
                            let endParts   = data.work_end_time.split(':');

                            let startHour   = parseInt(startParts[0]);
                            let startMinute = parseInt(startParts[1]);
                            let endHour     = parseInt(endParts[0]);
                            let endMinute   = parseInt(endParts[1]);

                            let appointmentSelect = $('#appointment_time');
                            appointmentSelect.empty().append('<option disabled selected hidden>Select Appointment Time</option>');

                            let current = new Date();
                            current.setHours(startHour, startMinute, 0, 0);

                            let end = new Date();
                            end.setHours(endHour, endMinute, 0, 0);

                            while (current <= end) {
                                let hh = current.getHours().toString().padStart(2, '0');
                                let mm = current.getMinutes().toString().padStart(2, '0');
                                let timeLabel = `${hh}:${mm}`;
                                appointmentSelect.append(`<option value="${timeLabel}:00">${timeLabel}</option>`);
                                current.setMinutes(current.getMinutes() + 30);
                            }
                        }
                    });

                    // 2) أيام العمل
                    $.ajax({
                        url: '/admin/doctor-working-days/' + doctorId,
                        type: 'GET',
                        success: function (doctorDays) {
                            let daySelect = $('#appointment_day');
                            daySelect.empty().append('<option disabled selected hidden>Select Day</option>');
                            doctorDays.forEach(function(day) {
                                daySelect.append('<option value="' + day + '">' + day + '</option>');
                            });
                        }
                    });
                }
            });
        });
    </script>
@endsection
