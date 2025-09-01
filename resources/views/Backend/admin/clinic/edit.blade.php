@extends('Backend.admin.master')

@section('title', 'Edit Profile Clinic')

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
        <h4 class="page-title" style="margin-bottom:30px;">Edit Profile Clinic</h4>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-8 offset-lg-2">
        <form method="POST" action="{{ route('update_clinic_profile', ['id' => $clinic->id]) }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          {{-- 1) Doctor Information --}}
          <div class="card">
            <div class="card-header">Clinic Information</div>
            <div class="card-body">
              <div class="row">
                {{-- Name --}}
                <div class="col-sm-6">
                  <label>Clinic Name <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-user-md"></i></span></div>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $clinic->name ?? '') }}">
                  </div>
                </div>

                {{-- Location --}}
                <div class="col-sm-6">
                    <label>Location <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span></div>
                      <input class="form-control" type="text" id="location" name="location" value="{{ old('location', $clinic->location ?? '') }}">
                    </div>
                </div>

                {{-- Phone --}}
                <div class="col-sm-6">
                  <label>Phone <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-phone"></i></span></div>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $clinic->phone ?? '') }}">
                  </div>
                </div>

                {{-- Email --}}
                <div class="col-sm-6">
                  <label>Email <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-envelope"></i></span></div>
                    <input class="form-control" type="email" id="email" name="email" value="{{ old('email', $clinic->email ?? '') }}">
                  </div>
                </div>

                {{-- Avatar --}}
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Logo</label>
                    <div class="profile-upload">
                      <div class="upload-img">
                        <img alt="" src="{{ asset($clinic->image) }}">
                      </div>
                      <div class="upload-input">
                        <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>

        {{-- 2) Work Schedule --}}
        <div class="card">
            <div class="card-header">Work Schedule</div>
            <div class="card-body">
                <div class="row">

                    {{-- Work Start --}}
                    <div class="col-sm-6 mb-3">
                        <label>Work Start <span class="text-danger">*</span></label>
                        <select name="work_start" id="work_start" class="form-control">
                            @for($i = 1; $i <= 24; $i++)
                                @php
                                    $timeValue = str_pad($i, 2, '0', STR_PAD_LEFT) . ':00:00'; // القيمة للحفظ
                                    $timeLabel = str_pad($i, 2, '0', STR_PAD_LEFT) . ':00';    // اللي يظهر للمستخدم
                                @endphp
                                <option value="{{ $timeValue }}"
                                    {{ (old('work_start', $clinic->work_start ?? '') == $timeValue) ? 'selected' : '' }}>
                                    {{ $timeLabel }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    {{-- Work End --}}
                    <div class="col-sm-6 mb-3">
                        <label>Work End <span class="text-danger">*</span></label>
                        <select name="work_end" id="work_end" class="form-control">
                            @for($i = 1; $i <= 24; $i++)
                                @php
                                    $timeValue = str_pad($i, 2, '0', STR_PAD_LEFT) . ':00:00';
                                    $timeLabel = str_pad($i, 2, '0', STR_PAD_LEFT) . ':00';
                                @endphp
                                <option value="{{ $timeValue }}"
                                    {{ (old('work_end', $clinic->work_end ?? '') == $timeValue) ? 'selected' : '' }}>
                                    {{ $timeLabel }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    {{-- Work Days --}}
                    <div class="col-sm-12 mt-3">
                        <label>Working Days <span class="text-danger">*</span></label>
                        <div class="row">
                            @php
                                $all_days   = ['Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday'];
                                $saved_days = $clinic->work_days ?? '[]';

                                $first_col_days = array_slice($all_days, 0, 4);
                                $second_col_days = array_slice($all_days, 4);
                            @endphp

                            <!-- العمود الأول -->
                            <div class="col-md-6">
                                @foreach($first_col_days as $day)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               name="work_days[]"
                                               value="{{ $day }}"
                                               id="day_{{ $day }}"
                                               {{ in_array($day, $saved_days) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="day_{{ $day }}">
                                            {{ $day }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <!-- العمود الثاني -->
                            <div class="col-md-6">
                                @foreach($second_col_days as $day)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               name="work_days[]"
                                               value="{{ $day }}"
                                               id="day_{{ $day }}"
                                               {{ in_array($day, $saved_days) ? 'checked' : '' }}>
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


          {{-- 3) Short Bio  --}}

          <div class="card">
            <div class="card-header">Description</div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $clinic->description) }}</textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {{-- Submit --}}
          <div class="text-center m-t-20" style="margin-top:20px;">
            <button type="submit" class="btn btn-primary submit-btn editBtn" style="text-transform:none !important;">Edit Profile Clinic</button>
          </div>

        </form>
      </div>
    </div>

  </div>
</div>
@endsection

@section('js')

<script>

  function isValidSelectValue(id) {
    const el = document.getElementById(id);
    if (!el) return false;
    const v = el.value;
    return v !== '' && v !== null && v !== undefined;
  }


  $(document).ready(function () {

    $('.editBtn').on('click', function (e) {
      e.preventDefault();

      const name = $('#name').val().trim();
      const location = $('#location').val().trim();
      const email = $('#email').val();
      const phone = $('#phone').val().trim();
      const work_start = $('#work_start').val();
      const work_end = $('#work_end').val();
      const logo = document.querySelector('#logo').files[0];
      const description = $('#description').val().trim();

      let workingDays = [];
      $('input[name="work_days[]"]:checked').each(function () {
        workingDays.push($(this).val());
      });

      if (!name || !email || !phone || !location || !isValidSelectValue('work_start') || !isValidSelectValue('work_end') || workingDays.length === 0) {
        Swal.fire({
          title: 'Error!',
          text: 'Please Enter All Required Fields',
          icon: 'error',
          confirmButtonText: 'OK'
        });
        return;
      }

      const formData = new FormData();
      formData.append('name', name);

      formData.append('email', email);

      formData.append('phone', phone);
      formData.append('location', location);
      formData.append('work_start', work_start);
      formData.append('work_end', work_end);
      formData.append('description', description);
      if (logo) formData.append('logo', logo);

      workingDays.forEach(d => formData.append('work_days[]', d));

      $.ajax({
        type: 'POST',
        url: "{{ route('update_clinic_profile', ['id' => $clinic->id]) }}",
        data: formData,
        processData: false,
        contentType: false,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          'X-HTTP-Method-Override': 'PUT'
        },
        success: function (response) {
          if (response.data == 1) {
            Swal.fire({
              title: 'Success',
              text: 'The Clinic Profile Has Been Updated Successfully',
              icon: 'success',
              confirmButtonText: 'OK'
            }).then(() => window.location.href = '/admin/clinic/profile');
          }
        },
      });
    });
  });
</script>
@endsection
