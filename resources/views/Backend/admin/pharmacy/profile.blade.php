@extends('Backend.master')

@section('title', 'Pharmacy Profile')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Pharmacy Profile</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pharmacy Profile</li>
                    </ul>
                </div>
                <div class="col-auto">
                    <a href="{{ route('pharmacy_view') }}" class="btn btn-primary">
                        <i class="fa fa-eye"></i> View Pharmacy
                    </a>
                </div>
            </div>
        </div>

        <!-- Pharmacy Profile Card -->
        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-header bg-gradient-primary text-white py-3">
                <h4 class="mb-0"><i class="fas fa-clinic-medical"></i> {{ $pharmacy->name ?? 'Clinic Pharmacy' }}</h4>
            </div>
            <div class="card-body p-4">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><i class="fas fa-map-marker-alt text-primary"></i> <strong>Location:</strong> {{ $pharmacy->location ?? 'Not set' }}</p>
                        <p><i class="fas fa-user-tie text-primary"></i> <strong>Manager:</strong> {{ $pharmacy->manager_name ?? 'Not set' }}</p>
                        <p><i class="fas fa-envelope text-primary"></i> <strong>Email:</strong> {{ $pharmacy->email ?? 'Not set' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><i class="fas fa-phone-alt text-primary"></i> <strong>Phone:</strong> {{ $pharmacy->phone ?? 'Not set' }}</p>
                        <p><i class="fas fa-clock text-primary"></i> <strong>Working Hours:</strong>
                            {{ $pharmacy->work_start_time ?? '--' }} - {{ $pharmacy->work_end_time ?? '--' }}
                        </p>
                        <p><i class="fas fa-calendar-alt text-primary"></i> <strong>Working Days:</strong>
                            @if($pharmacy->working_days)
                                {{ implode(', ', $pharmacy->working_days) }}
                            @else
                                Not Set
                            @endif
                        </p>
                    </div>
                </div>

                <div class="mb-3">
                    <h5><i class="fas fa-info-circle text-primary"></i> Description</h5>
                    <p>{{ $pharmacy->description ?? 'No description available.' }}</p>
                </div>

                <div class="text-right">
                    <a href="{{ route('pharmacy_profile') }}" class="btn btn-success">
                        <i class="fa fa-edit"></i> Edit Profile
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
