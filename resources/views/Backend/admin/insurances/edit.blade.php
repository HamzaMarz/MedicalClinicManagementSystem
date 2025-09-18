@extends('Backend.admin.master')

@section('title' , 'Edit Insurance Provider')

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
        <h4 class="page-title" style="margin-bottom:30px;">Edit Insurance Provider</h4>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-8 offset-lg-2">
        <form id="editInsuranceForm" method="POST" action="{{ route('update_insurance_provider', $insurance_provider->id) }}">
          @csrf
          @method('PUT')

          <div class="card">
            <div class="card-header">Insurance Provider Information</div>
            <div class="card-body">
              <div class="row">

                <div class="col-sm-6">
                  <label>Company Name <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-building"></i></span></div>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $insurance_provider->name }}">
                  </div>
                </div>

                <div class="col-sm-6">
                  <label>Phone <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-phone"></i></span></div>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $insurance_provider->phone }}">
                  </div>
                </div>

                <div class="col-sm-6">
                  <label>Email <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-envelope"></i></span></div>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $insurance_provider->email }}">
                  </div>
                </div>

                <div class="col-sm-6">
                  <label>Address <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span></div>
                    <input type="text" class="form-control" id="address" name="address" value="{{ $insurance_provider->address }}">
                  </div>
                </div>

                <div class="col-sm-6">
                  <label>Representative Name <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-user-tie"></i></span></div>
                    <input type="text" class="form-control" id="representative_name" name="representative_name" value="{{ $insurance_provider->representative_name }}">
                  </div>
                </div>

                <div class="col-sm-6">
                  <label>Representative Phone <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-mobile-alt"></i></span></div>
                    <input type="text" class="form-control" id="representative_phone" name="representative_phone" value="{{ $insurance_provider->representative_phone }}">
                  </div>
                </div>

                <div class="col-sm-12" style="margin-top:20px;">
                    <label class="d-block">Status</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="active" value="active" {{ $insurance_provider->status == 'active' ? 'checked' : '' }}>
                        <label class="form-check-label" for="active">Active</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="inactive" value="inactive" {{ $insurance_provider->status == 'inactive' ? 'checked' : '' }}>
                        <label class="form-check-label" for="inactive">Inactive</label>
                    </div>
                </div>

              </div>
            </div>
          </div>

          <div class="text-center" style="margin-top:20px;">
            <button type="submit" class="btn btn-primary submit-btn editBtn" style="text-transform:none !important;">Edit Insurance Provider</button>
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
        $('.editBtn').click(function (e) {
            e.preventDefault();

            let name                = $('#name').val().trim();
            let phone               = $('#phone').val().trim();
            let email               = $('#email').val().trim();
            let address             = $('#address').val().trim();
            let representative_name = $('#representative_name').val().trim();
            let representative_phone= $('#representative_phone').val().trim();
            let status              = $('input[name="status"]:checked').val();

            let formData = new FormData();
            formData.append('_method', 'PUT');
            formData.append('name', name);
            formData.append('phone', phone);
            formData.append('email', email);
            formData.append('address', address);
            formData.append('representative_name', representative_name);
            formData.append('representative_phone', representative_phone);
            formData.append('status', status);

            if (name === '' || phone === '' || email === '' || address === '' || representative_name === '' || representative_phone === '') {
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
                url: "{{ route('update_insurance_provider', $insurance_provider->id) }}",
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
                            text: 'This Insurance Provider Already Exists',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    } else if (response.data == 1) {
                        Swal.fire({
                            title: 'Success',
                            text: 'Insurance Provider Has Been Updated Successfully',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = '/admin/view/insurances-providers';
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Something Went Wrong, Please Try Again',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });
</script>
@endsection
