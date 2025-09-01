@extends('Backend.admin.master')

@section('title' , 'Edit Medication')

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
                <h4 class="page-title" style="margin-bottom: 30px;">Edit Medication</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form id="medicationForm" method="POST" action="{{ route('update_medication' , ['id' => $medication->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Medication Info --}}
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
                                        <input class="form-control" type="text" id="name" name="name" value="{{ $medication->name }}">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label>Dosage Form <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-vial"></i></span>
                                        </div>
                                        <select class="form-control" id="dosage_form" name="dosage_form">
                                            <option value="" disabled hidden>Select Form</option>
                                            <option value="Tablet" {{ $medication->dosage_form == 'Tablet' ? 'selected' : '' }}>Tablet</option>
                                            <option value="Capsule" {{ $medication->dosage_form == 'Capsule' ? 'selected' : '' }}>Capsule</option>
                                            <option value="Syrup" {{ $medication->dosage_form == 'Syrup' ? 'selected' : '' }}>Syrup</option>
                                            <option value="Injection" {{ $medication->dosage_form == 'Injection' ? 'selected' : '' }}>Injection</option>
                                            <option value="Suppository" {{ $medication->dosage_form == 'Suppository' ? 'selected' : '' }}>Suppository</option>
                                            <option value="Ointment" {{ $medication->dosage_form == 'Ointment' ? 'selected' : '' }}>Ointment</option>
                                            <option value="Cream" {{ $medication->dosage_form == 'Cream' ? 'selected' : '' }}>Cream</option>
                                            <option value="Drop" {{ $medication->dosage_form == 'Drop' ? 'selected' : '' }}>Drop</option>
                                            <option value="Spray" {{ $medication->dosage_form == 'Spray' ? 'selected' : '' }}>Spray</option>
                                            <option value="Powder" {{ $medication->dosage_form == 'Powder' ? 'selected' : '' }}>Powder</option>
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
                                            <option value="" disabled hidden>Select Category</option>
                                            <option value="Antibiotic" {{ $medication->category == 'Antibiotic' ? 'selected' : '' }}>Antibiotic</option>
                                            <option value="Analgesic" {{ $medication->category == 'Analgesic' ? 'selected' : '' }}>Analgesic</option>
                                            <option value="Anti-inflammatory" {{ $medication->category == 'Anti-inflammatory' ? 'selected' : '' }}>Anti-inflammatory</option>
                                            <option value="Antiviral" {{ $medication->category == 'Antiviral' ? 'selected' : '' }}>Antiviral</option>
                                            <option value="Antifungal" {{ $medication->category == 'Antifungal' ? 'selected' : '' }}>Antifungal</option>
                                            <option value="Vitamins" {{ $medication->category == 'Vitamins' ? 'selected' : '' }}>Vitamins & Supplements</option>
                                            <option value="Cardiovascular" {{ $medication->category == 'Cardiovascular' ? 'selected' : '' }}>Cardiovascular</option>
                                            <option value="Antidiabetic" {{ $medication->category == 'Antidiabetic' ? 'selected' : '' }}>Antidiabetic</option>
                                            <option value="Sedatives" {{ $medication->category == 'Sedatives' ? 'selected' : '' }}>Sedatives</option>
                                            <option value="Other" {{ $medication->category == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label>Expiry Date <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" id="expiry_date" name="expiry_date" class="form-control" value="{{ $medication->expiry_date }}">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label>Selling Price <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                        </div>
                                        <input class="form-control" type="number" id="selling_price" name="selling_price" value="{{ $medication->selling_price }}">
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
                                <textarea id="description" name="description" class="form-control" rows="4" placeholder="Write a short description about the medication...">{{ old('description', $medication->description) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="text-center m-t-20" style="margin-top:20px;">
                        <button type="submit" class="btn btn-primary submit-btn editBtn" style="text-transform: none !important;">
                            Edit Medication
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
            let expiryDate   = $('#expiry_date').val().trim();
            let sellingPrice = $('#selling_price').val().trim();

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
                url: "{{ route('update_medication', ['id' => $medication->id]) }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.data == 1) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Medication Has Been Updated Successfully',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = '/admin/view/medications';
                        });
                    } else {
                        Swal.fire('Error!', 'Update Failed, Please Try Again.', 'error');
                    }
                },
            });
        });
    });
</script>
@endsection
