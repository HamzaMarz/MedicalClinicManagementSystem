@extends('Backend.admin.master')

@section('title' , 'Add Patient Insurance')

@section('content')

<style>
    .col-sm-6 { margin-bottom: 20px; }
    input[type="date"] { direction: ltr; text-align: left; }
    .card + .card { margin-top: 20px; }
    .card-header { font-weight: 600; }

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
        <h4 class="page-title" style="margin-bottom:30px;">Add Patient Insurance</h4>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-8 offset-lg-2">
        <form method="POST" action="{{ Route('store_patient_insurance') }}">
          @csrf

          {{-- Patient Insurance Information --}}
          <div class="card">
            <div class="card-header">Patient Insurance Information</div>
            <div class="card-body">
              <div class="row">

                {{-- Patient --}}
                <div class="col-sm-6">
                  <label>Patient <span class="text-danger">*</span></label>
                  <select class="form-control" id="patient_id" name="patient_id" required>
                      <option disabled selected hidden>Select Patient</option>
                      @foreach($patients as $patient)
                          <option value="{{ $patient->id }}">{{ $patient->user->name }}</option>
                      @endforeach
                  </select>
                </div>

                {{-- Insurance Provider --}}
                <div class="col-sm-6">
                  <label>Insurance Provider <span class="text-danger">*</span></label>
                  <select class="form-control" id="provider_id" name="provider_id" required>
                      <option disabled selected hidden>Select Provider</option>
                      @foreach($insurances_providers as $provider)
                          <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                      @endforeach
                  </select>
                </div>


                {{-- Start Date --}}
                <div class="col-sm-6">
                    <label>Start Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                  </div>

                {{-- End Date --}}
                <div class="col-sm-6">
                    <label>End Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                </div>


                  {{-- Coverage Percentage --}}
                <div class="col-sm-6">
                    <label>Coverage Percentage (%) <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-percent"></i></span>
                        </div>
                        <input type="number" min="0" max="100" step="0.01" class="form-control" id="coverage_percentage" name="coverage_percentage">
                    </div>
                  </div>

              </div>
            </div>
          </div>

          <div class="text-center" style="margin-top:20px;">
            <button type="submit" class="btn btn-primary submit-btn" style="text-transform:none !important;">
                Add Patient Insurance
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
    $(document).ready(function () {
        $('.submit-btn').click(function (e) {
            e.preventDefault();

            let patient_id           = $('#patient_id').val();
            let provider_id          = $('#provider_id').val();
            let start_date           = $('#start_date').val();
            let end_date             = $('#end_date').val();
            let coverage_percentage  = $('#coverage_percentage').val();

            let formData = new FormData();
            formData.append('patient_id', patient_id);
            formData.append('provider_id', provider_id);
            formData.append('start_date', start_date);
            formData.append('end_date', end_date);
            formData.append('coverage_percentage', coverage_percentage);

            if (!patient_id || !provider_id || coverage_percentage === '' || start_date === '' || end_date === '') {
                Swal.fire({
                    title: 'Error!',
                    text: 'Please Enter All Required Fields',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return;
            } else if (coverage_percentage < 5 || coverage_percentage > 100) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Coverage Percentage must be between 5% and 100%',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return;
            }

            $.ajax({
                method: 'POST',
                url: "{{ route('store_patient_insurance') }}",
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
                            text: 'This Patient Insurance Already Exists',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    } else if (response.data == 1) {
                        Swal.fire({
                            title: 'Success',
                            text: 'Patient Insurance Has Been Added Successfully',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = '/admin/add/patient-insurance';
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Server Error, Please Try Again',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });
</script>
@endsection
