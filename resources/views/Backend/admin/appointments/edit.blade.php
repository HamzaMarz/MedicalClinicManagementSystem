@extends('Backend.admin.master')

@section('title' , 'Edit Appointment')

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
                <h4 class="page-title" style="margin-bottom: 30px;">Edit Appointment</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form method="POST" action="{{ Route('update_appointment' , ['id' => $appointment->id]) }}">
                    @csrf
                    @method('PUT')

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
                                            <option value="" disabled hidden>Select Patient</option>
                                            @foreach($patients as $patient)
                                                <option value="{{ $patient->id }}" {{ $patient->id == $appointment->patient_id ? 'selected' : '' }}>
                                                    {{ $patient->user->name }}
                                                </option>
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
                                            <option value="" disabled hidden>Select Department</option>
                                            @foreach($departments as $department)
                                                <option value="{{ $department->id }}" {{ $department->id == $appointment->department_id ? 'selected' : '' }}>
                                                    {{ $department->name }}
                                                </option>
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
                                            <option value="" disabled hidden>Select Doctor</option>
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
                                            <option value="" disabled hidden>Select Appointment Time</option>
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
                                            <option value="" disabled hidden>Select Day</option>
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
                                <textarea class="form-control" id="notes" name="notes" rows="3">{{ $appointment->notes }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="text-center m-t-20" style="margin-top:20px;">
                        <button type="submit" class="btn btn-primary submit-btn addBtn" style="text-transform:none !important;">
                            Edit Appointment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')
@php
    $appointmentDay = $appointment->date ? \Carbon\Carbon::parse($appointment->date)->format('l') : '';
    $selectedTime = $appointment->time ?? '';
@endphp

<script>
    function isValidSelectValue(selectId) {
        let val = $(`#${selectId}`).val();
        return val && $(`#${selectId} option[value="${val}"]`).length > 0;
    }

    $(document).ready(function () {
        $('.addBtn').click(function (e) {
            e.preventDefault();

            let patient_id       = $('#patient_id').val();
            let department_id    = $('#department_id').val();
            let doctor_id        = $('#doctor_id').val();
            let appointment_time = $('#appointment_time').val();
            let appointment_day  = $('#appointment_day').val();
            let notes            = $('#notes').val().trim();


            let formData = new FormData();
            formData.append('_method', 'PUT');
            formData.append('patient_id', patient_id);
            formData.append('department_id', department_id);
            formData.append('doctor_id', doctor_id);
            formData.append('appointment_time', appointment_time);
            formData.append('appointment_day', appointment_day);
            formData.append('notes', notes);

            if (!isValidSelectValue('patient_id') || !isValidSelectValue('department_id') || !isValidSelectValue('doctor_id') || !isValidSelectValue('appointment_time') || !isValidSelectValue('appointment_day')) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Please Enter All Required Fields',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return;
            } else {
                $.ajax({
                    method: 'POST',
                    url: "{{ route('update_appointment', ['id' => $appointment->id]) }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'X-HTTP-Method-Override': 'PUT'
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
                            Swal.fire('Success', 'Appointment Has Been Updated Successfully', 'success')
                                .then(() => {
                                    window.location.href = '/admin/view/appointments';
                                });
                        }
                        else {
                            Swal.fire('Notice', 'Unexpected response, please try again', 'info');
                        }
                    }
                });
            }
        });
    });

    function loadDoctors(departmentId, selectedDoctorId = '') {
        $('#doctor_id').empty().append('<option value="" disabled hidden>Select Doctor</option>');
        if (departmentId) {
            $.get('/admin/get-doctors-by-department/' + departmentId, function (doctors) {
                doctors.forEach(function (doctor) {
                    $('#doctor_id').append(`<option value="${doctor.id}" ${doctor.id == selectedDoctorId ? 'selected' : ''}>${doctor.name}</option>`);
                });
                if (selectedDoctorId) loadDoctorData(selectedDoctorId);
            });
        }
    }

    function loadDoctorData(doctorId) {
        $.get('/admin/get-doctor-info/' + doctorId, function (data) {
            let appointmentSelect = $('#appointment_time');
            appointmentSelect.empty().append('<option disabled hidden>Select Appointment Time</option>');

            let current = new Date();
            let end = new Date();

            let [startHour, startMinute] = data.work_start_time.split(':').map(Number);
            let [endHour, endMinute] = data.work_end_time.split(':').map(Number);

            current.setHours(startHour, startMinute, 0, 0);
            end.setHours(endHour, endMinute, 0, 0);

            let selectedTime = "{{ $selectedTime }}";

            while (current <= end) {
                let hh = String(current.getHours()).padStart(2, '0');
                let mm = String(current.getMinutes()).padStart(2, '0');
                let time = `${hh}:${mm}:00`;
                appointmentSelect.append(`<option value="${time}" ${time === selectedTime ? 'selected' : ''}>${hh}:${mm}</option>`);
                current.setMinutes(current.getMinutes() + 30);
            }
        });

        $.get('/admin/doctor-working-days/' + doctorId, function (doctorDays) {
            let daySelect = $('#appointment_day');
            daySelect.empty().append('<option value="" disabled hidden>Select Day</option>');

            const selectedDay = "{{ $appointmentDay }}";

            doctorDays.forEach(function(day) {
                const selected = (day === selectedDay) ? 'selected' : '';
                daySelect.append(`<option value="${day}" ${selected}>${day}</option>`);
            });
        });
    }

    $(document).ready(function () {
        let selectedDepartmentId = "{{ $appointment->department_id ?? '' }}";
        let selectedDoctorId = "{{ $appointment->doctor_id ?? '' }}";

        if (selectedDepartmentId) {
            loadDoctors(selectedDepartmentId, selectedDoctorId);
        }

        $('#department_id').on('change', function () {
            let departmentId = $(this).val();
            loadDoctors(departmentId);
        });

        $('#doctor_id').on('change', function () {
            let doctorId = $(this).val();
            if (doctorId) loadDoctorData(doctorId);
        });

        if (selectedDoctorId) {
            loadDoctorData(selectedDoctorId);
        }
    });
</script>
@endsection
