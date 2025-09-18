@extends('Backend.admin.master')

@section('title' , 'Add New Employee')

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
                <h4 class="page-title" style="margin-bottom:30px;">Add New Employee</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form method="POST" action="{{ route('store_employee') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- 1) Employee Information --}}
                    <div class="card">
                        <div class="card-header">Employee Information</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Employee Name <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label>Date of Birth <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label>Phone <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="phone" name="phone">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                        </div>
                                        <input type="email" class="form-control" id="email" name="email">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label>Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                        </div>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label>Confirm Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                        </div>
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label>Address</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="address" name="address">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label>Avatar</label>
                                    <div class="profile-upload">
                                        <div class="upload-img">
                                            <img alt="" src="{{ asset('assets/img/user.jpg') }}">
                                        </div>
                                        <div class="upload-input">
                                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group gender-select">
                                        <label class="gen-label">Gender: <span class="text-danger">*</span></label>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" id="gender" name="gender" class="form-check-input" value="male">Male
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" id="gender" name="gender" class="form-check-input" value="female">Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 2) Work Assignment --}}
                    <div class="card">
                        <div class="card-header">Work Assignment</div>
                        <div class="card-body">
                            <div class="row small-gutter">

                                {{-- Job Title --}}
                                <div class="row small-gutter">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Job Titles <span class="text-danger">*</span></label>
                                            <div class="row gx-1">
                                                <div class="col-6">
                                                    @foreach(array_slice($job_titles->toArray(), 0, ceil(count($job_titles)/2)) as $title)
                                                        <div class="form-check">
                                                            <input class="form-check-input"
                                                                   type="checkbox"
                                                                   name="job_title_id[]"
                                                                   value="{{ $title['id'] }}"
                                                                   id="job_{{ $title['id'] }}"
                                                                   data-need-department="{{ $title['need_department'] ?? 0 }}"
                                                                   data-need-doctor="{{ $title['need_doctor'] ?? 0 }}"
                                                                   {{ !empty($employee) && in_array($title['id'], $employee->jobTitles->pluck('id')->toArray() ?? []) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="job_{{ $title['id'] }}">{{ $title['name'] }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="col-6">
                                                    @foreach(array_slice($job_titles->toArray(), ceil(count($job_titles)/2)) as $title)
                                                        <div class="form-check">
                                                            <input class="form-check-input"
                                                                   type="checkbox"
                                                                   name="job_title_id[]"
                                                                   value="{{ $title['id'] }}"
                                                                   id="job_{{ $title['id'] }}"
                                                                   data-need-department="{{ $title['need_department'] ?? 0 }}"
                                                                   data-need-doctor="{{ $title['need_doctor'] ?? 0 }}"
                                                                   {{ !empty($employee) && in_array($title['id'], $employee->jobTitles->pluck('id')->toArray() ?? []) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="job_{{ $title['id'] }}">{{ $title['name'] }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6" id="department_field" style="display:none; margin-top:20px;">
                                    <label>Department <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-building"></i>
                                            </span>
                                        </div>
                                        <select id="department_id" name="department_id" class="form-control">
                                            <option disabled selected hidden>Select Department</option>
                                            @foreach($departments as $department)
                                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- 3) Doctor Job Information --}}
                    <div class="card" id="doctor_info_card" style="display:none;">
                        <div class="card-header">Doctor Job Information</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Specialty <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-stethoscope"></i>
                                            </span>
                                        </div>
                                        <select id="specialty_id" name="specialty_id" class="form-control">
                                            <option disabled selected hidden>Select Specialty</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label>Qualification <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-graduation-cap"></i></span>
                                        </div>
                                        <select id="qualification" name="qualification" class="form-control">
                                            <option disabled selected hidden>Select Qualification</option>
                                            <option value="MBBS">MBBS</option>
                                            <option value="MD">MD</option>
                                            <option value="DO">DO</option>
                                            <option value="BDS">BDS</option>
                                            <option value="PhD">PhD</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label>Experience Years <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-briefcase"></i></span>
                                        </div>
                                        <input type="number" min="0" class="form-control" id="experience_years" name="experience_years" placeholder="Enter Years">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label>Consultation Fee <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-file-invoice-dollar"></i></span>
                                        </div>
                                        <input class="form-control" type="number" min="0" id="consultation_fee" name="consultation_fee">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 4) Work Schedule --}}
                    <div class="card">
                        <div class="card-header">Work Schedule</div>
                        <div class="card-body">
                            <div class="row">

                                {{-- Start Time --}}
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Work Start Time <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                            </div>
                                            <select name="work_start_time" id="work_start_time" class="form-control">
                                                <option disabled selected hidden>Select Start Time</option>
                                                @php
                                                    $start = \Carbon\Carbon::createFromFormat('H:i:s', $clinic->work_start);
                                                    $end   = \Carbon\Carbon::createFromFormat('H:i:s', $clinic->work_end);
                                                @endphp
                                                @for ($time = $start->copy(); $time->lte($end); $time->addHour())
                                                    <option value="{{ $time->format('H:i:s') }}">
                                                        {{ $time->format('H:i') }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                {{-- End Time --}}
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Work End Time <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                            </div>
                                            <select name="work_end_time" id="work_end_time" class="form-control">
                                                <option disabled selected hidden>Select End Time</option>
                                                @for ($time = $start->copy(); $time->lte($end); $time->addHour())
                                                    <option value="{{ $time->format('H:i:s') }}">
                                                        {{ $time->format('H:i') }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                {{-- Working Days --}}
                                <div class="row small-gutter w-100">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Working Days <span class="text-danger">*</span></label>
                                            <div class="row gx-1">
                                                @php
                                                    $daysColumn1 = ['Saturday','Sunday','Monday','Tuesday'];
                                                    $daysColumn2 = ['Wednesday','Thursday','Friday'];
                                                    $clinicDays  = $clinic->work_days ?? [];
                                                @endphp

                                                {{-- العمود الأول --}}
                                                <div class="col-6">
                                                    @foreach($daysColumn1 as $day)
                                                        <div class="form-check {{ in_array($day, $clinicDays) ? '' : 'text-muted' }}">
                                                            <input class="form-check-input"
                                                                   type="checkbox"
                                                                   name="working_days[]"
                                                                   value="{{ $day }}"
                                                                   id="day_{{ $day }}"
                                                                   {{ in_array($day, $clinicDays) ? '' : 'disabled' }}>
                                                            <label class="form-check-label" for="day_{{ $day }}">
                                                                {{ $day }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                {{-- العمود الثاني --}}
                                                <div class="col-6">
                                                    @foreach($daysColumn2 as $day)
                                                        <div class="form-check {{ in_array($day, $clinicDays) ? '' : 'text-muted' }}">
                                                            <input class="form-check-input"
                                                                   type="checkbox"
                                                                   name="working_days[]"
                                                                   value="{{ $day }}"
                                                                   id="day_{{ $day }}"
                                                                   {{ in_array($day, $clinicDays) ? '' : 'disabled' }}>
                                                            <label class="form-check-label" for="day_{{ $day }}">
                                                                {{ $day }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- 5) Short Biography & Status --}}
                    <div class="card">
                        <div class="card-header">Short Biography & Status</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-sm-12">
                                    <label for="short_biography">Short Biography</label>
                                    <textarea id="short_biography" name="short_biography" class="form-control" rows="4" placeholder="Write a short bio..."></textarea>
                                </div>

                                <div class="col-sm-12">
                                    <label class="d-block">Account Status</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="active" value="active" checked>
                                        <label class="form-check-label" for="active">Active</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="inactive" value="inactive">
                                        <label class="form-check-label" for="inactive">Inactive</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center" style="margin-top:20px;">
                        <button type="submit" class="btn btn-primary submit-btn px-5 rounded-pill" style="text-transform:none !important;">
                            Add Employee
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script>
$(document).ready(function () {

    $('form').on('submit', function (e) {
        e.preventDefault();

        let name = $('#name').val().trim();
        let date_of_birth = $('#date_of_birth').val().trim();
        let department_id = $('#department_id').val();
        let specialty_id = $('#specialty_id').val();
        let email = $('#email').val().trim();
        let password = $('#password').val();
        let confirm_password = $('#confirm_password').val();
        let phone = $('#phone').val().trim();
        let address = $('#address').val().trim();
        let work_start_time = $('#work_start_time').val();
        let work_end_time = $('#work_end_time').val();
        let qualification = $('#qualification').val();
        let experience_years = $('#experience_years').val().trim();
        let consultation_fee = $('#consultation_fee').val().trim();
        let gender = $('input[name="gender"]:checked').val();
        let short_biography = $('#short_biography').val().trim();
        let status = $('input[name="status"]:checked').val();
        let image = document.querySelector('#image').files[0];


        let jobTitles = [];
        $('input[name="job_title_id[]"]:checked').each(function () {
            jobTitles.push($(this).val());
        });

        let workingDays = [];
        $('input[name="working_days[]"]:checked').each(function () {
            workingDays.push($(this).val());
        });

        let formData = new FormData();
        formData.append('name', name);
        formData.append('date_of_birth', date_of_birth);
        if (department_id) formData.append('department_id', department_id);
        formData.append('email', email);
        formData.append('password', password);
        formData.append('confirm_password', confirm_password);
        formData.append('phone', phone);
        formData.append('address', address);
        formData.append('work_start_time', work_start_time);
        formData.append('work_end_time', work_end_time);
        formData.append('gender', gender);
        formData.append('short_biography', short_biography);
        formData.append('status', status);
        if (image) formData.append('image', image);

        jobTitles.forEach(function (id) {
            formData.append('job_title_id[]', id);
        });

        workingDays.forEach(function (day) {
            formData.append('working_days[]', day);
        });

        if ($('#doctor_info_card').is(':visible')) {
            formData.append('qualification', qualification);
            formData.append('experience_years', experience_years);
            formData.append('specialty_id', specialty_id);
            formData.append('consultation_fee', consultation_fee);
        }

        let start = moment(work_start_time, "HH:mm");
        let end   = moment(work_end_time, "HH:mm");

        if (name === '' || date_of_birth === '' || email === '' || phone === '' || address === '' ||
            jobTitles.length === 0 || workingDays.length === 0 || !work_start_time || !work_end_time || gender === undefined) {
            Swal.fire({ title: 'Error!',
                text: 'Please Enter All Required Fields',
                icon: 'error'
            });
            return;
        } else if (password !== confirm_password) {
            Swal.fire({ title: 'Error!',
                text: 'The Password Does Not Match The Confirmation Password',
                icon: 'error'
            });
            return;
        } else if ($('#doctor_info_card').is(':visible') && (consultation_fee <= 0)){
            Swal.fire({
                title: 'Error!',
                text: 'The Consultation Fee Is Invalid',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return;
        }else if (!start.isBefore(end)) {
            Swal.fire({ title: 'Error!',
                text: 'The Timing Is Incorrect, Please Correct It',
                icon: 'error'
            });
            return;
        } else if ($('#department_field').is(':visible') && !department_id) {
            Swal.fire({ title: 'Error!', text: 'Please Select Department', icon: 'error' });
            return;
        } else if ($('#doctor_info_card').is(':visible') && (!qualification || !experience_years || !specialty_id)) {
            Swal.fire({ title: 'Error!', text: 'Please Fill All Doctor Job Information Fields', icon: 'error' });
            return;
        }


        $.ajax({
            method: 'POST',
            url: "{{ route('store_employee') }}",
            data: formData,
            processData: false,
            contentType: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function (response) {
                if (response.data == 0) {
                    Swal.fire({ title: 'Error!', text: 'This Employee Already Exists', icon: 'error' });
                } else if (response.data == 1) {
                    Swal.fire({ title: 'Success', text: 'Employee Has Been Added Successfully', icon: 'success' })
                        .then(() => { window.location.href = '/admin/add/employee'; });
                }
            }
        });
    });

    $('#department_id').on('change', function () {
        const departmentId = $(this).val();
        if (!departmentId) return;

        $.get('/admin/get-specialties-by-department/' + departmentId, function (data) {
            const specialtySelect = $('#specialty_id');
            specialtySelect.empty().append('<option disabled selected hidden>Select Specialty</option>');
            $.each(data, function (i, specialty) {
                specialtySelect.append('<option value="' + specialty.id + '">' + specialty.name + '</option>');
            });
        });
    });


    $('input[name="job_title_id[]"]').change(function () {
        let needDepartment = $('input[name="job_title_id[]"]:checked').filter(function () {
            return $(this).data('need-department') == 1;
        }).length > 0;

        let isDoctorSelected = $('input[name="job_title_id[]"]:checked').filter(function () {
            return $(this).next('label').text().toLowerCase().includes('doctor');
        }).length > 0;

        if (needDepartment) {
            $('#department_field').show();
        } else {
            $('#department_field').hide();
            $('#department_id').val('');
        }

        if (isDoctorSelected) {
            $('#doctor_info_card').show();
        } else {
            $('#doctor_info_card').hide();
            $('#qualification, #experience_years, #specialty_id, #consultation_fee').val('');
        }
    });
});
</script>
@endsection

