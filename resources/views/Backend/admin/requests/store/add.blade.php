@extends('Backend.admin.master')

@section('title' , 'Store Medication Supply Request')

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
                <h4 class="page-title" style="margin-bottom: 30px;">Store Medication Supply Request</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form id="medicationForm" method="POST" action="{{ route('store_store_request') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">Medication Supply to Store</div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-sm-6">
                                    <label>Medication Name <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-capsules"></i></span>
                                        </div>
                                        <select class="form-control" id="medication_id" name="medication_id">
                                            <option value="" disabled selected hidden>Select Medication</option>
                                            @foreach($medications as $medication)
                                                <option value="{{ $medication->id }}">{{ $medication->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label>Quantity <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-capsules"></i></span>
                                        </div>
                                        <input class="form-control" type="number" id="quantity" name="quantity">
                                        <div class="input-group-append">
                                            <span class="input-group-text">carton</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="text-center m-t-20" style="margin-top:20px;">
                        <button type="submit" class="btn btn-primary submit-btn" style="text-transform: none !important;">
                            Send Request
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
        $('#medicationForm').on('submit', function (e) {
            e.preventDefault();

            let medication_id = $('#medication_id').val();
            let quantity      = $('#quantity').val();

            if (medication_id === '' || quantity === '') {
                Swal.fire({
                    title: 'Error!',
                    text: 'Please select a medication and enter the quantity',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return;
            }

            let formData = new FormData(this);

            $.ajax({
                method: 'POST',
                url: "{{ route('store_store_request') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.data == 1) {
                        Swal.fire({
                            title: 'Success',
                            text: 'Medication Request Has Been Sent Successfully',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = '/admin/create/store/request';
                        });
                    }
                },
            });
        });
    });
</script>
@endsection
