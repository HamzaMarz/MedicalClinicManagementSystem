@extends('Backend.admin.master')

@section('title', 'Edit Doctor')

@section('content')

<style>
  .col-sm-6{ margin-bottom:20px; }
  input[type="date"]{ direction:ltr; text-align:left; }
  .card + .card{ margin-top:20px; }
  .card-header{ font-weight:600; }
  .small-gutter > [class^="col-"]{ padding-left:30px !important; margin-top:15px !important; }
  .card{ border:1px solid #ddd !important; border-radius:8px !important; box-shadow:0 4px 10px rgba(0,0,0,.08) !important; overflow:hidden !important; }
  .card-header{ background-color:#00A8FF !important; color:#fff !important; font-weight:600 !important; padding:12px 15px !important; font-size:16px !important; border-bottom:1px solid #ddd !important; }
  .card-body{ background-color:#fff; padding:20px; }
  .profile-upload .upload-img img{ width:80px; height:80px; object-fit:cover; border-radius:8px; }
</style>

<div class="page-wrapper">
  <div class="content">
    <div class="row">
      <div class="col-lg-8 offset-lg-2">
        <h4 class="page-title" style="margin-bottom:30px;">Edit Doctor</h4>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-8 offset-lg-2">
        <form method="POST" action="{{ route('update_doctor', ['id' => $doctor->id]) }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="card">
            <div class="card-header">Doctor Information</div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-6">
                  <label>Doctor Name <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-user-md"></i></span></div>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name ?? '') }}">
                  </div>
                </div>
                <div class="col-sm-6">
                  <label>Date of Birth <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar-alt"></i></span></div>
                    <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" dir="ltr" lang="en" value="{{ old('date_of_birth', $user->date_of_birth ?? '') }}">
                  </div>
                </div>
                <div class="col-sm-6">
                  <label>Phone <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-phone"></i></span></div>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone ?? '') }}">
                  </div>
                </div>
                <div class="col-sm-6">
                  <label>Email <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-envelope"></i></span></div>
                    <input class="form-control" type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}">
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
                  <label>Address <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span></div>
                    <input class="form-control" type="text" id="address" name="address" value="{{ old('address', $user->address ?? '') }}">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Avatar</label>
                    <div class="profile-upload">
                      <div class="upload-img">
                        <img alt="doctor image" src="{{ asset($user->image ?? 'assets/img/user.jpg') }}">
                      </div>
                      <div class="upload-input">
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group gender-select">
                    <label class="gen-label">Gender: <span class="text-danger">*</span></label>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" name="gender" value="male" class="form-check-input" {{ old('gender', $user->gender ?? '') === 'male' ? 'checked' : '' }}> Male
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" name="gender" value="female" class="form-check-input" {{ old('gender', $user->gender ?? '') === 'female' ? 'checked' : '' }}> Female
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header">Assignment</div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Department <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-building"></i></span>
                      </div>
                      <select id="department_id" name="department_id" class="form-control">
                        <option disabled hidden>Select Department</option>
                        @foreach($departments as $department)
                          <option value="{{ $department->id }}" {{ $doctor->employee->department_id == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                          </option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Specialty <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-stethoscope"></i></span>
                      </div>
                      <select id="specialty_id" name="specialty_id" class="form-control">
                        <option disabled hidden>Select Specialty</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header">Professional Information</div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-6">
                  <label>Qualification <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-user-graduate"></i></span></div>
                    @php
                      $qualifications = ['MBBS','MD','DO','BDS','PhD','MSc','Fellowship','Diploma'];
                      $selectedQualification = old('qualification', $doctor->qualification ?? null);
                    @endphp
                    <select class="form-control" id="qualification" name="qualification">
                      <option disabled {{ $selectedQualification ? '' : 'selected' }} hidden>Select Qualification</option>
                      @foreach($qualifications as $q)
                        <option value="{{ $q }}" @selected($selectedQualification === $q)>{{ $q }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <label>Experience Years <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-briefcase"></i></span></div>
                    <input class="form-control" type="number" min="0" id="experience_years" name="experience_years" value="{{ old('experience_years', $doctor->experience_years ?? '') }}">
                  </div>
                </div>
                <div class="col-sm-6">
                  <label>Consultation Fee <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-file-invoice-dollar"></i></span></div>
                    <input class="form-control" type="number" min="0" id="consultation_fee" name="consultation_fee" value="{{ old('consultation_fee', $doctor->consultation_fee ?? '') }}">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header">Work Schedule</div>
            <div class="card-body">
              <div class="row">
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
                          $savedStart = $employee->work_start_time ?? null;
                        @endphp
                        @for ($time = $start->copy(); $time->lte($end); $time->addHour())
                          <option value="{{ $time->format('H:i:s') }}" {{ $savedStart === $time->format('H:i:s') ? 'selected' : '' }}>
                            {{ $time->format('H:i') }}
                          </option>
                        @endfor
                      </select>
                    </div>
                  </div>
                </div>
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
                          $savedEnd = $employee->work_end_time ?? null;
                        @endphp
                        @for ($time = $start->copy(); $time->lte($end); $time->addHour())
                          <option value="{{ $time->format('H:i:s') }}" {{ $savedEnd === $time->format('H:i:s') ? 'selected' : '' }}>
                            {{ $time->format('H:i') }}
                          </option>
                        @endfor
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row small-gutter">
                    <div class="col-sm-12" id="working_days">
                        <label>Working Days <span class="text-danger">*</span></label>
                        @php
                          $all_days = ['Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday'];
                          $clinicDays = $work_days ?? []; 
                          $selectedDays = old('working_days', $doctor->employee->working_days ?? []);
                        @endphp
                        <div class="row">
                          <div class="col-6">
                            @foreach(array_slice($all_days,0,4) as $day)
                              <div class="form-check {{ in_array($day,$clinicDays) ? '' : 'text-muted' }}">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="working_days[]"
                                       value="{{ $day }}"
                                       id="day_{{ $day }}"
                                       {{ in_array($day,$selectedDays) ? 'checked' : '' }}
                                       {{ in_array($day,$clinicDays) ? '' : 'disabled' }}>
                                <label class="form-check-label" for="day_{{ $day }}">{{ $day }}</label>
                              </div>
                            @endforeach
                          </div>
                          <div class="col-6">
                            @foreach(array_slice($all_days,4) as $day)
                              <div class="form-check {{ in_array($day,$clinicDays) ? '' : 'text-muted' }}">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="working_days[]"
                                       value="{{ $day }}"
                                       id="day_{{ $day }}"
                                       {{ in_array($day,$selectedDays) ? 'checked' : '' }}
                                       {{ in_array($day,$clinicDays) ? '' : 'disabled' }}>
                                <label class="form-check-label" for="day_{{ $day }}">{{ $day }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header">Short Biography & Status</div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Short Biography</label>
                    <textarea class="form-control" id="short_biography" name="short_biography" rows="3">{{ old('short_biography', $doctor->employee->short_biography ?? '') }}</textarea>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="display-block">Status</label>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="status" id="doctor_active" value="active" {{ old('status', $doctor->status ?? 'active') === 'active' ? 'checked' : '' }}>
                      <label class="form-check-label" for="doctor_active">Active</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="status" id="doctor_inactive" value="inactive" {{ old('status', $doctor->status ?? '') === 'inactive' ? 'checked' : '' }}>
                      <label class="form-check-label" for="doctor_inactive">Inactive</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="text-center m-t-20" style="margin-top:20px;">
            <button type="submit" class="btn btn-primary submit-btn editBtn" style="text-transform:none !important;">Edit Doctor</button>
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

        // ✅ عند الضغط على زر التعديل
        $('.editBtn').click(function (e) {
            e.preventDefault();

            // 🔹 جمع القيم من الحقول
            let name              = $('#name').val().trim();
            let date_of_birth     = $('#date_of_birth').val().trim();
            let department_id     = $('#department_id').val();
            let specialty_id      = $('#specialty_id').val();
            let email             = $('#email').val();
            let password          = $('#password').val();
            let confirm_password  = $('#confirm_password').val();
            let phone             = $('#phone').val().trim();
            let address           = $('#address').val().trim();
            let work_start_time   = $('#work_start_time').val();
            let work_end_time     = $('#work_end_time').val();
            let gender            = $('input[name="gender"]:checked').val();
            let short_biography   = $('#short_biography').val().trim();
            let status            = $('input[name="status"]:checked').val();
            let image             = document.querySelector('#image').files[0];
            let qualification     = $('#qualification').val().trim();
            let experience_years  = $('#experience_years').val();
            let consultation_fee  = $('#consultation_fee').val();

            let workingDays = [];
            $('input[name="working_days[]"]:checked').each(function () {
                workingDays.push($(this).val());
            });

            // ✅ تجهيز البيانات
            let formData = new FormData();
            formData.append('name', name);
            formData.append('date_of_birth', date_of_birth);
            formData.append('department_id', department_id);
            formData.append('specialty_id', specialty_id);
            formData.append('email', email);
            formData.append('password', password);
            formData.append('confirm_password', confirm_password);
            formData.append('phone', phone);
            formData.append('address', address);
            formData.append('work_start_time', work_start_time);
            formData.append('work_end_time', work_end_time);
            formData.append('qualification', qualification);
            formData.append('experience_years', experience_years);
            formData.append('consultation_fee', consultation_fee);
            formData.append('gender', gender);
            formData.append('short_biography', short_biography);
            formData.append('status', status);

            if (image) {
                formData.append('image', image);
            }

            workingDays.forEach(function (day) {
                formData.append('working_days[]', day);
            });

            // ✅ التحقق من الحقول
            if (name === '' || date_of_birth === '' 
                || !isValidSelectValue('department_id') 
                || !isValidSelectValue('specialty_id')
                || email === '' || phone === '' || address === '' 
                || !isValidSelectValue('qualification') 
                || experience_years === '' || consultation_fee === '' 
                || !isValidSelectValue('work_start_time') 
                || !isValidSelectValue('work_end_time') 
                || gender === undefined  
                || $('input[name="working_days[]"]:checked').length === 0) {

                Swal.fire({
                    title: 'Error!',
                    text: 'Please Enter All Required Fields',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return;
            } 
            else if (password && password !== confirm_password) {
                Swal.fire({
                    title: 'Error!',
                    text: 'The Password Does Not Match The Confirmation Password',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return;
            } 
            else if (consultation_fee <= 0) {
                Swal.fire({
                    title: 'Error!',
                    text: 'The Consultation Fee Is Invalid',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return;
            } 
            else if (work_start_time >= work_end_time) {
                Swal.fire({
                    title: 'Error!',
                    text: 'The Timing Is Incorrect, Please Correct It',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // ✅ إرسال الطلب Ajax
            $.ajax({
                method: 'POST',
                url: "{{ route('update_doctor', ['id' => $doctor->id]) }}",
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
                            text: 'This Doctor Already Exists',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    } else if (response.data == 1) {
                        Swal.fire({
                            title: 'Success',
                            text: 'Doctor Has Been Updated Successfully',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = '/admin/view/doctors';
                        });
                    } else {
                        Swal.fire({
                            title: 'Notice',
                            text: 'Unexpected response. Please try again.',
                            icon: 'info',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            });
        });

        // ✅ تحميل التخصصات عند اختيار القسم
        $('#department_id').on('change', function () {
            let departmentId = $(this).val();

            if (departmentId) {
                $.ajax({
                    url: '/admin/get-specialties-by-department/' + departmentId,
                    type: 'GET',
                    success: function (data) {
                        $('#specialty_id').empty();
                        $('#specialty_id').append('<option disabled selected hidden>Select Specialty</option>');
                        $.each(data, function (key, value) {
                            $('#specialty_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    },
                    error: function () {
                        alert('Failed to load specialties!');
                    }
                });
            }
        });

        // ✅ تحميل التخصص المحفوظ مسبقاً
        let savedSpecialtyId = "{{ $doctor->specialty_id }}";
        let departmentId = $('#department_id').val();
        if (departmentId) {
            $.ajax({
                url: '/admin/get-specialties-by-department/' + departmentId,
                type: 'GET',
                success: function (data) {
                    $('#specialty_id').empty();
                    $('#specialty_id').append('<option disabled hidden>Select Specialty</option>');
                    $.each(data, function (key, value) {
                        let selected = (value.id == savedSpecialtyId) ? 'selected' : '';
                        $('#specialty_id').append('<option value="' + value.id + '" ' + selected + '>' + value.name + '</option>');
                    });
                }
            });
        }

    });
</script>
@endsection
