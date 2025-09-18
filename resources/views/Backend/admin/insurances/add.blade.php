@extends('Backend.admin.master')

@section('title' , 'Add New Insurance Provider')

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
        background-color: #00A8FF !important; /* اللون الأزرق */
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
        <h4 class="page-title" style="margin-bottom:30px;">Add New Insurance Provider</h4>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-8 offset-lg-2">
        <form method="POST" action="{{ Route('store_insurance_provider') }}">
          @csrf

          {{-- Insurance Provider Information --}}
          <div class="card">
            <div class="card-header">Insurance Provider Information</div>
            <div class="card-body">
              <div class="row">

                <div class="col-sm-6">
                  <label>Company Name <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-building"></i></span>
                    </div>
                    <input type="text" class="form-control" id="name" name="name" required>
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
                  <label>Address <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                    </div>
                    <input type="text" class="form-control" id="address" name="address">
                  </div>
                </div>

                <div class="col-sm-6">
                  <label>Representative Name <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                    </div>
                    <input type="text" class="form-control" id="representative_name" name="representative_name">
                  </div>
                </div>

                <div class="col-sm-6">
                  <label>Representative Phone <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-mobile-alt"></i></span>
                    </div>
                    <input type="text" class="form-control" id="representative_phone" name="representative_phone">
                  </div>
                </div>


                <div class="col-sm-12" style="margin-top:20px;">
                    <label class="d-block">Status</label>
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

          <div class="text-center m-t-20" style="margin-top:20px;">
            <button type="submit" class="btn btn-primary submit-btn" style="text-transform:none !important;">
                Add Insurance Provider
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

            let name                = $('#name').val().trim();
            let phone               = $('#phone').val().trim();
            let email               = $('#email').val().trim();
            let address             = $('#address').val().trim();
            let representative_name = $('#representative_name').val().trim();
            let representative_phone= $('#representative_phone').val().trim();
            let status = $('input[name="status"]:checked').val();

            let formData = new FormData();
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
                url: "{{ route('store_insurance_provider') }}",
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
                            text: 'Insurance Provider Has Been Added Successfully',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = '/admin/add/insurance-provider';
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
