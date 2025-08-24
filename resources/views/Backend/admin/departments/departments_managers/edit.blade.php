@extends('Backend.master')

@section('title' , 'Edit Department Manager')

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
                <h4 class="page-title" style="margin-bottom:30px;">Edit Department Manager</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form  method="POST" action="{{ route('update_department_manager', ['id' => $departmentManager->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" id="departmentManager_id" value="{{ $departmentManager->id }}">

                    {{-- 1) Employee Information --}}
                    <div class="card">
                        <div class="card-header">Department Manager Information</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Department Manager Name <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $departmentManager->user->name }}">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label>Date of Birth <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ $departmentManager->user->date_of_birth }}">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label>Phone <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $departmentManager->user->phone }}">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                        </div>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $departmentManager->user->email }}">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label>Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                        </div>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password (optional)">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label>Confirm Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                        </div>
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter Confirm new password">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label>Address</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="address" name="address" value="{{ $departmentManager->user->address }}">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label>Avatar</label>
                                    <div class="profile-upload">
                                        <div class="upload-img">
                                            <img alt="" src="{{ asset($departmentManager->user->image ?? 'assets/img/user.jpg') }}">
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
                                          <input type="radio" id="gender" name="gender" class="form-check-input" value="male" {{ old('gender', $user->gender ?? '') === 'male' ? 'checked' : '' }}>Male
                                        </label>
                                      </div>
                                      <div class="form-check-inline">
                                        <label class="form-check-label">
                                          <input type="radio" id="gender" name="gender" class="form-check-input" value="female" {{ old('gender', $user->gender ?? '') === 'female' ? 'checked' : '' }}>Female
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
                            <div class="row">

                                <div class="col-sm-6">
                                    <label>Department <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-stethoscope"></i></span>
                                        </div>
                                        <select id="department_id" name="department_id" class="form-control">
                                            <option disabled hidden>Select Department</option>
                                            @foreach($departments as $department)
                                                <option value="{{ $department->id }}"
                                                    {{ $departmentManager->department_id == $department->id ? 'selected' : '' }}>
                                                    {{ $department->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 3) Work Schedule --}}
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
                                                    <option disabled hidden>Select Start Time</option>
                                                    @php
                                                        $start = \Carbon\Carbon::createFromFormat('H:i:s', $clinic->work_start);
                                                        $end   = \Carbon\Carbon::createFromFormat('H:i:s', $clinic->work_end);
                                                        $savedStart = $departmentManager->work_start_time ?? null; // القيمة المخزنة
                                                    @endphp
                                                    @for ($time = $start->copy(); $time->lte($end); $time->addHour())
                                                        <option value="{{ $time->format('H:i:s') }}"
                                                            {{ $savedStart === $time->format('H:i:s') ? 'selected' : '' }}>
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
                                                    <option disabled hidden>Select End Time</option>
                                                    @php
                                                        $savedEnd = $departmentManager->work_end_time ?? null; 
                                                    @endphp
                                                    @for ($time = $start->copy(); $time->lte($end); $time->addHour())
                                                        <option value="{{ $time->format('H:i:s') }}"
                                                            {{ $savedEnd === $time->format('H:i:s') ? 'selected' : '' }}>
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
                                                        $clinicDays  = $clinic->work_days ?? []; // أيام العيادة
                                                        $savedDays   = $departmentManager->working_days ?? []; // الأيام المحفوظة للموظف
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
                                                                    {{ in_array($day, $clinicDays) ? '' : 'disabled' }}
                                                                    {{ in_array($day, $savedDays ?? []) ? 'checked' : '' }}>
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
                                                                    {{ in_array($day, $clinicDays) ? '' : 'disabled' }}
                                                                    {{ in_array($day, $savedDays ?? []) ? 'checked' : '' }}>
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


                    {{-- 4) Status --}}
                    <div class="card">
                        <div class="card-header">Short Biography & Status</div>
                        <div class="card-body">
                            <div class="row">
                                {{-- Short Biography --}}
                                <div class="mb-3 col-sm-12">
                                    <label for="short_biography">Short Biography</label>
                                    <div class="input-group">
                                        <textarea id="short_biography" name="short_biography" class="form-control" rows="4" placeholder="Write a short bio...">{{ $departmentManager->short_biography }}</textarea>
                                    </div>
                                </div>

                                {{-- Account Status --}}
                                <div class="mb-3 col-sm-12">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="departmentManager_active" value="active"
                                        {{ old('status', $departmentManager->status ?? 'active') === 'active' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="departmentManager_active">Active</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="departmentManager_inactive" value="inactive"
                                        {{ old('status', $departmentManager->status ?? '') === 'inactive' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="departmentManager_inactive">Inactive</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="text-center" style="margin-top:20px;">
                        <button type="submit" class="btn btn-primary submit-btn addBtn" style="text-transform:none !important;">
                            Edit Department Manager
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
        function isValidSelectValue(selectId) {      // هذا الميثود حتى أتجنب خداع الفيكفيار
            let val = $(`#${selectId}`).val();
            return val !== '' && val !== null && val !== undefined && $(`#${selectId} option[value="${val}"]`).length > 0;
        }

        $(document).ready(function () {
            $('.addBtn').click(function (e) {
                e.preventDefault();

                let departmentManagerId = $('#departmentManager_id').val();
                let name = $('#name').val().trim();
                let date_of_birth = $('#date_of_birth').val().trim();
                let department_id = $('#department_id').val();
                let email = $('#email').val();
                let password = $('#password').val();
                let confirm_password = $('#confirm_password').val();
                let phone = $('#phone').val().trim();
                let address = $('#address').val().trim();
                let work_start_time = $('#work_start_time').val();
                let work_end_time = $('#work_end_time').val();
                let gender = $('input[name="gender"]:checked').val();
                let short_biography = $('#short_biography').val().trim();
                let status = $('input[name="status"]:checked').val();
                let image = document.querySelector('#image').files[0];

                let workingDays = [];
                $('input[name="working_days[]"]:checked').each(function () {
                    workingDays.push($(this).val());
                });


                // ✅ استخدم FormData
                let formData = new FormData();
                formData.append('_method', 'PUT');
                formData.append('name', name);
                formData.append('date_of_birth', date_of_birth);
                formData.append('department_id', department_id);
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
                if (image) {
                    formData.append('image', image);
                }


                workingDays.forEach(function (day) {
                    formData.append('working_days[]', day);
                });


                if (name === '' || date_of_birth === '' || !isValidSelectValue('department_id')  || email === '' || phone === '' || address === '' || workingDays.length === 0 || !isValidSelectValue('work_start_time') || !isValidSelectValue('work_end_time') || gender === undefined) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Please Enter All Required Fields',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    return;
                }else if (password !== confirm_password){
                    Swal.fire({
                        title: 'Error!',
                        text: 'The Password Does Not Match The Confirmation Password',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    return;
                }else{
                    $.ajax({
                        method: 'POST',
                        url: "{{ route('update_department_manager', ['id' => $departmentManager->id]) }}",
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'X-HTTP-Method-Override': 'PUT'
                        },
                    success: function (response) {
                        if (response.data == 0) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'This Email Already Exists',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        } else if (response.data == 1) {
                            Swal.fire({
                                title: 'Success',
                                text: 'Department Manager Has Been Edited Successfully',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.href = '/admin/view/departments-managers';
                            });
                        }
                    }
                });
            }
        });
    });
    </script>
@endsection











