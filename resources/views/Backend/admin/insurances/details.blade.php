@extends('Backend.admin.master')

@section('title' , 'Insurance Provider Details')

@section('content')
<style>
    .details-card {
        border: 1px solid #ddd;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        margin-bottom: 30px;
        overflow: hidden; /* عشان الهيدر الأزرق يغطي كامل العرض */
    }
    .details-header {
        background-color: #00A8FF;
        color: #fff;
        padding: 15px;
        font-size: 18px;
        font-weight: bold;
        width: 100%;
    }
    .details-body {
        padding: 20px;
    }
    .details-item {
        display: flex;
        align-items: center;
        margin-bottom: 25px;
    }
    .details-item i {
        font-size: 20px;
        color: #00A8FF;
        width: 30px;
    }
    .details-label {
        font-weight: 600;
        width: 180px;
    }
    .status-active {
        padding: 6px 18px;
        border-radius: 50px;
        background: #13ee29;
        color: #fff;
        font-weight: bold;
    }
    .status-inactive {
        padding: 6px 18px;
        border-radius: 50px;
        background: #f90d25;
        color: #fff;
        font-weight: bold;
    }
</style>

<div class="page-wrapper">
  <div class="content">
    <div class="row">
      <div class="col-lg-8 offset-lg-2">

        {{-- ✅ كرت معلومات الشركة --}}
        <div class="details-card">
            <div class="details-header">
                <i class="fas fa-building"></i> Insurance Provider Information
            </div>

            <div class="details-body">
                <div class="details-item">
                    <i class="fas fa-building"></i>
                    <div class="details-label">Company Name:</div>
                    <div>{{ $insurance_provider->name }}</div>
                </div>

                <div class="details-item">
                    <i class="fa fa-envelope"></i>
                    <div class="details-label">Email:</div>
                    <div>{{ $insurance_provider->email }}</div>
                </div>

                <div class="details-item">
                    <i class="fa fa-phone"></i>
                    <div class="details-label">Phone:</div>
                    <div>{{ $insurance_provider->phone }}</div>
                </div>


                <div class="details-item">
                    <i class="fa fa-map-marker-alt"></i>
                    <div class="details-label">Address:</div>
                    <div>{{ $insurance_provider->address }}</div>
                </div>

                <div class="details-item">
                    <i class="fa fa-check-circle"></i>
                    <div class="details-label">Status:</div>
                    <div>
                        @if($insurance_provider->status === 'active')
                            <span class="status-active">Active</span>
                        @else
                            <span class="status-inactive">Inactive</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- ✅ كرت معلومات المندوب --}}
        <div class="details-card">
            <div class="details-header">
                <i class="fas fa-user-tie"></i> Representative Information
            </div>

            <div class="details-body">
                <div class="details-item">
                    <i class="fas fa-user-tie"></i>
                    <div class="details-label">Representative Name:</div>
                    <div>{{ $insurance_provider->representative_name }}</div>
                </div>

                <div class="details-item">
                    <i class="fa fa-mobile-alt"></i>
                    <div class="details-label">Representative Phone:</div>
                    <div>{{ $insurance_provider->representative_phone }}</div>
                </div>
            </div>
        </div>

        <div class="mb-3 d-flex justify-content-end">
            <a href="{{ Route('view_insurances_providers') }}" class="btn btn-primary rounded-pill" style="font-weight: bold;">
                Back
            </a>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
