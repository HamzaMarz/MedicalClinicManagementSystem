@extends('Backend.admin.master')

@section('title' , 'Edit Employee')

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
                <h4 class="page-title" style="margin-bottom:30px;">Edit Employee</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form id="editEmployeeForm" method="POST" action="{{ route('update_employee', ['id' => $employee->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- 1) Employee Information --}}
                    <div class="card">
                        <div class="card-header">Employee Information</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Employee Name <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user"></i></span></div>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $employee->user->name }}">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label>Date of Birth <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar-alt"></i></span></div>
                                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ $employee->user->date_of_birth }}">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label>Phone <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-phone"></i></span></div>
                                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $employee->user->phone }}">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-envelope"></i></span></div>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $employee->user->email }}">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label>Password</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-lock"></i></span></div>
                                      <input class="form-control" type="password" id="password" name="password" placeholder="Enter new password (optional)">
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <label>Confirm Password</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-lock"></i></span></div>
                                      <input class="form-control" type="password" id="confirm_password" name="confirm_password" placeholder="Enter Confirm new password">
                                    </div>
                                  </div>

                                <div class="col-sm-6">
                                    <label>Address</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span></div>
                                        <input type="text" class="form-control" id="address" name="address" value="{{ $employee->user->address }}">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label>Avatar</label>
                                    <div class="profile-upload">
                                        <div class="upload-img">
                                            <img alt="" src="{{ $employee->user->image ? asset('storage/'.$employee->user->image) : asset('assets/img/user.jpg') }}">
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
                                                <input type="radio" name="gender" value="male" class="form-check-input" {{ $employee->user->gender == 'male' ? 'checked' : '' }}>Male
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" name="gender" value="female" class="form-check-input" {{ $employee->user->gender == 'female' ? 'checked' : '' }}>Female
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
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Job Titles <span class="text-danger">*</span></label>
                                        <div class="row gx-1">
                                            <div class="col-6">
                                                @foreach(array_slice($jobTitles->toArray(), 0, ceil(count($jobTitles)/2)) as $title)
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                               type="checkbox"
                                                               name="job_title_id[]"
                                                               value="{{ $title['id'] }}"
                                                               id="job_{{ $title['id'] }}"
                                                               data-need-department="{{ $title['need_department'] ?? 0 }}"
                                                               data-need-doctor="{{ $title['need_doctor'] ?? 0 }}"
                                                               {{ in_array($title['id'], $employee->jobTitles->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="job_{{ $title['id'] }}">{{ $title['name'] }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="col-6">
                                                @foreach(array_slice($jobTitles->toArray(), ceil(count($jobTitles)/2)) as $title)
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                               type="checkbox"
                                                               name="job_title_id[]"
                                                               value="{{ $title['id'] }}"
                                                               id="job_{{ $title['id'] }}"
                                                               data-need-department="{{ $title['need_department'] ?? 0 }}"
                                                               data-need-doctor="{{ $title['need_doctor'] ?? 0 }}"
                                                               {{ in_array($title['id'], $employee->jobTitles->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="job_{{ $title['id'] }}">{{ $title['name'] }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6" id="department_field" style="{{ $employee->department_id ? '' : 'display:none;' }} margin-top:20px;">
                                    <label>Department <span class="text-danger">*</span></label>
                                    <select id="department_id" name="department_id" class="form-control">
                                        <option disabled hidden>Select Department</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}" {{ $employee->department_id == $department->id ? 'selected' : '' }}>
                                                {{ $department->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 3) Doctor Job Information --}}
                    <div class="card" id="doctor_info_card" style="{{ $employee->doctor ? '' : 'display:none;' }}">
                        <div class="card-header">Doctor Job Information</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Specialty <span class="text-danger">*</span></label>
                                    <select id="specialty_id" name="specialty_id" class="form-control">
                                        <option disabled selected hidden>Select Specialty</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label>Qualification <span class="text-danger">*</span></label>
                                    <select id="qualification" name="qualification" class="form-control">
                                        <option disabled hidden>Select Qualification</option>
                                        <option value="MBBS" {{ $employee->doctor && $employee->doctor->qualification == 'MBBS' ? 'selected' : '' }}>MBBS</option>
                                        <option value="MD" {{ $employee->doctor && $employee->doctor->qualification == 'MD' ? 'selected' : '' }}>MD</option>
                                        <option value="DO" {{ $employee->doctor && $employee->doctor->qualification == 'DO' ? 'selected' : '' }}>DO</option>
                                        <option value="BDS" {{ $employee->doctor && $employee->doctor->qualification == 'BDS' ? 'selected' : '' }}>BDS</option>
                                        <option value="PhD" {{ $employee->doctor && $employee->doctor->qualification == 'PhD' ? 'selected' : '' }}>PhD</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label>Experience Years <span class="text-danger">*</span></label>
                                    <input type="number" min="0" class="form-control" id="experience_years" name="experience_years"
                                        value="{{ optional($employee->doctor)->experience_years }}">
                                </div>
                                <div class="col-sm-6">
                                    <label>Consultation Fee <span class="text-danger">*</span></label>
                                    <input type="number" min="0" class="form-control" id="consultation_fee" name="consultation_fee"
                                        value="{{ optional($employee->doctor)->consultation_fee }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 4) Work Schedule --}}
                    <div class="card">
                        <div class="card-header">Work Schedule</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Work Start Time <span class="text-danger">*</span></label>
                                    <select name="work_start_time" id="work_start_time" class="form-control">
                                        <option disabled hidden>Select Start Time</option>
                                        @php
                                            $start = \Carbon\Carbon::createFromFormat('H:i:s', $clinic->work_start);
                                            $end   = \Carbon\Carbon::createFromFormat('H:i:s', $clinic->work_end);
                                        @endphp
                                        @for ($time = $start->copy(); $time->lte($end); $time->addHour())
                                            <option value="{{ $time->format('H:i:s') }}" {{ $employee->work_start_time == $time->format('H:i:s') ? 'selected' : '' }}>
                                                {{ $time->format('H:i') }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <label>Work End Time <span class="text-danger">*</span></label>
                                    <select name="work_end_time" id="work_end_time" class="form-control">
                                        <option disabled hidden>Select End Time</option>
                                        @for ($time = $start->copy(); $time->lte($end); $time->addHour())
                                            <option value="{{ $time->format('H:i:s') }}" {{ $employee->work_end_time == $time->format('H:i:s') ? 'selected' : '' }}>
                                                {{ $time->format('H:i') }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>

                                {{-- Working Days --}}
                                <div class="col-sm-6">
                                    <label>Working Days <span class="text-danger">*</span></label>
                                    @php
                                        $all_days = ['Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday'];
                                        $selectedDays = $employee->working_days ?? [];
                                    @endphp
                                    <div class="row gx-1">
                                        <div class="col-6">
                                            @foreach(array_slice($all_days, 0, 4) as $day)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="working_days[]" value="{{ $day }}" id="day_{{ $day }}" {{ in_array($day, $selectedDays) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="day_{{ $day }}">{{ $day }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="col-6">
                                            @foreach(array_slice($all_days, 4) as $day)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="working_days[]" value="{{ $day }}" id="day_{{ $day }}" {{ in_array($day, $selectedDays) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="day_{{ $day }}">{{ $day }}</label>
                                                </div>
                                            @endforeach
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
                                    <textarea id="short_biography" name="short_biography" class="form-control" rows="4">{{ $employee->short_biography }}</textarea>
                                </div>

                                <div class="col-sm-12">
                                    <label class="d-block">Account Status</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" value="active" {{ $employee->status == 'active' ? 'checked' : '' }}>
                                        <label class="form-check-label">Active</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" value="inactive" {{ $employee->status == 'inactive' ? 'checked' : '' }}>
                                        <label class="form-check-label">Inactive</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center" style="margin-top:20px;">
                        <button type="submit" class="btn btn-primary submit-btn editBtn" style="text-transform:none !important;">Edit Employee</button>
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
    function isValidSelectValue(selectId) {
        let val = $(`#${selectId}`).val();
        return val !== '' && val !== null && val !== undefined &&
               $(`#${selectId} option[value="${val}"]`).length > 0;
    }

    $(document).ready(function () {

        let currentSpecialtyId = @json(optional($employee->doctor)->specialty_id);

        $('.editBtn').click(function (e) {
            e.preventDefault();

            let name             = $('#name').val().trim();
            let date_of_birth    = $('#date_of_birth').val().trim();
            let department_id    = $('#department_id').val();
            let email            = $('#email').val();
            let password         = $('#password').val();
            let confirm_password = $('#confirm_password').val();
            let phone            = $('#phone').val().trim();
            let address          = $('#address').val().trim();
            let work_start_time  = $('#work_start_time').val();
            let work_end_time    = $('#work_end_time').val();
            let gender           = $('input[name="gender"]:checked').val();
            let short_biography  = $('#short_biography').val().trim();
            let status           = $('input[name="status"]:checked').val();
            let image            = document.querySelector('#image').files[0];

            // حقول الدكتور
            let qualification    = $('#qualification').val();
            let experience_years = $('#experience_years').val();
            let specialty_id     = $('#specialty_id').val();
            let consultation_fee     = $('#consultation_fee').val();

            let jobTitles = [];
            $('input[name="job_title_id[]"]:checked').each(function () {
                jobTitles.push($(this).val());
            });

            let workingDays = [];
            $('input[name="working_days[]"]:checked').each(function () {
                workingDays.push($(this).val());
            });

            // ✅ FormData
            let formData = new FormData();
            formData.append('_method', 'PUT');
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

            jobTitles.forEach(id => formData.append('job_title_id[]', id));
            workingDays.forEach(day => formData.append('working_days[]', day));

            // أضف بيانات الدكتور إذا الكرت ظاهر
            if ($('#doctor_info_card').is(':visible')) {
                formData.append('qualification', qualification);
                formData.append('experience_years', experience_years);
                formData.append('specialty_id', specialty_id);
                formData.append('consultation_fee', consultation_fee);
            }

            // ✅ التحقق
            let start = moment(work_start_time, "HH:mm");
            let end   = moment(work_end_time, "HH:mm");

            if (name === '' || date_of_birth === '' || !isValidSelectValue('department_id') ||
                email === '' || phone === '' || address === '' ||
                !isValidSelectValue('work_start_time') || !isValidSelectValue('work_end_time') ||
                gender === undefined || workingDays.length === 0) {

                Swal.fire({ title: 'Error!', text: 'Please Enter All Required Fields', icon: 'error' });
                return;
            } else if (password !== confirm_password) {
                Swal.fire({ title: 'Error!', text: 'The Password Does Not Match The Confirmation Password', icon: 'error' });
                return;
            } else if ($('#doctor_info_card').is(':visible') && (consultation_fee <= 0)){
                Swal.fire({
                    title: 'Error!',
                    text: 'The Consultation Fee Is Invalid',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return;
            } else if (!start.isBefore(end)) {
                Swal.fire({ title: 'Error!', text: 'The Timing Is Incorrect, Please Correct It', icon: 'error' });
                return;
            } else if ($('#doctor_info_card').is(':visible') && (!qualification || !experience_years || !specialty_id || !consultation_fee)) {
                Swal.fire({ title: 'Error!', text: 'Please Fill All Doctor Job Information Fields', icon: 'error' });
                return;
            }

            // ✅ Ajax Submit
            $.ajax({
                method: 'POST',
                url: "{{ Route('update_employee' , ['id' => $employee->id]) }}",
                data: formData,
                processData: false,
                contentType: false,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    if (response.data == 0) {
                        Swal.fire({ title: 'Error!', text: 'This Employee Already Exists', icon: 'error' });
                    } else if (response.data == 1) {
                        Swal.fire({
                            title: 'Success',
                            text: 'Employee Has Been Updated Successfully',
                            icon: 'success'
                        }).then(() => { window.location.href = '/admin/view/employees'; });
                    }
                }
            });
        });


        // ✅ عند تغيير القسم → حمل تخصصاته
        $('#department_id').on('change', function () {
            const departmentId = $(this).val();
            if (!departmentId) return;

            $.get('/admin/get-specialties-by-department/' + departmentId, function (data) {
                const specialtySelect = $('#specialty_id');
                specialtySelect.empty().append('<option value="" disabled selected hidden>Select Specialty</option>');
                $.each(data, function (i, specialty) {
                    specialtySelect.append('<option value="' + specialty.id + '">' + specialty.name + '</option>');
                });
            });
        });

        // ✅ عند فتح الصفحة: حمّل التخصص المحفوظ
        let departmentId = $('#department_id').val();
        if (departmentId && currentSpecialtyId) {
            $.get('/admin/get-specialties-by-department/' + departmentId, function (data) {
                const specialtySelect = $('#specialty_id');
                specialtySelect.empty().append('<option value="" disabled selected hidden>Select Specialty</option>');
                $.each(data, function (i, specialty) {
                    let selected = (specialty.id == currentSpecialtyId) ? 'selected' : '';
                    specialtySelect.append('<option value="' + specialty.id + '" ' + selected + '>' + specialty.name + '</option>');
                });
            });
        }

        // ✅ عند اختيار/إلغاء Doctor
        $('input[name="job_title_id[]"]').change(function () {
            let isDoctorSelected = false;
            $('input[name="job_title_id[]"]:checked').each(function () {
                let jobName = $(this).next('label').text().trim().toLowerCase();
                if (jobName.includes('doctor')) isDoctorSelected = true;
            });

            if (isDoctorSelected) {
                $('#doctor_info_card').show();
                $('#qualification, #experience_years, #specialty_id').prop('required', true);
            } else {
                $('#doctor_info_card').hide();
                $('#qualification, #experience_years, #specialty_id').prop('required', false).val('');
            }
        });

        // ✅ إذا كان الموظف دكتور مسبقاً
        let currentJobTitles = @json($employee->jobTitles->pluck('name')->toArray() ?? []);
        if (currentJobTitles.some(title => title.toLowerCase().includes('doctor'))) {
            $('#doctor_info_card').show();
            $('#qualification, #experience_years, #specialty_id').prop('required', true);
        }
    });
</script>
@endsection


