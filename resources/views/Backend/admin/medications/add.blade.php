@extends('Backend.master')

@section('title' , 'Add New Medication')

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
                <h4 class="page-title" style="margin-bottom: 30px;">Add New Medication</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form id="medicationForm" method="POST" action="{{ route('store_medication') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="card">
                        <div class="card-header">Medication Information</div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-sm-6">
                                    <label>Medication Name <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-capsules"></i></span>
                                        </div>
                                        <input class="form-control" type="text" id="name" name="name">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label>Dosage Form <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-vial"></i></span>
                                        </div>
                                        <select class="form-control" id="dosage_form" name="dosage_form">
                                            <option value="" disabled selected hidden>Select Form</option>
                                            <option value="Tablet">Tablet</option>
                                            <option value="Capsule">Capsule</option>
                                            <option value="Syrup">Syrup</option>
                                            <option value="Injection">Injection</option>
                                            <option value="Suppository">Suppository</option>
                                            <option value="Ointment">Ointment</option>
                                            <option value="Cream">Cream</option>
                                            <option value="Drop">Drop</option>
                                            <option value="Spray">Spray</option>
                                            <option value="Powder">Powder</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label>Category <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-capsules"></i></span>
                                        </div>
                                        <select class="form-control" id="category" name="category">
                                            <option value="" disabled selected hidden>Select Category</option>
                                            <option value="Antibiotic">Antibiotic</option>
                                            <option value="Analgesic">Analgesic</option>
                                            <option value="Anti-inflammatory">Anti-inflammatory</option>
                                            <option value="Antiviral">Antiviral</option>
                                            <option value="Antifungal">Antifungal</option>
                                            <option value="Vitamins">Vitamins & Supplements</option>
                                            <option value="Cardiovascular">Cardiovascular</option>
                                            <option value="Antidiabetic">Antidiabetic</option>
                                            <option value="Sedatives">Sedatives</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label>Expiry Date <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" id="expiry_date" name="expiry_date" class="form-control" dir="ltr" lang="en">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label>Selling Price <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                        </div>
                                        <input class="form-control" type="number" id="selling_price" name="selling_price">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="card">
                        <div class="card-header">Medication Description</div>
                        <div class="card-body">
                            <div class="form-group">
                                <textarea id="description" name="description" class="form-control" rows="4" placeholder="Write a short description about the medication...">{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="text-center m-t-20" style="margin-top:20px;">
                        <button type="submit" class="btn btn-primary submit-btn" style="text-transform: none !important;">
                            Add Medication
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

        let name         = $('#name').val().trim();
        let dosage_form  = $('#dosage_form').val();
        let category     = $('#category').val();
        let sellingPrice = $('#selling_price').val().trim();
        let expiryDate   = $('#expiry_date').val();
        let description  = $('#description').val().trim();

        if (name === '' || !dosage_form || !category || sellingPrice === '' || expiryDate === '') {
            Swal.fire({
                title: 'Error!',
                text: 'Please Enter All Required Fields',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return;
        }

        let formData = new FormData(this);

        $.ajax({
            method: 'POST',
            url: "{{ route('store_medication') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.data == 0) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'This Medication Already Exists',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                } else if (response.data == 1) {
                    Swal.fire({
                        title: 'Success',
                        text: 'Medication Has Been Added Successfully',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = '/admin/add/medication';
                    });
                }
            },
        });
    });
});
</script>
@endsection
