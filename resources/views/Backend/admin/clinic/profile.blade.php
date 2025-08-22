@extends('Backend.master')

@section('title' , 'Clinic Profile')

@section('content')

<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Clinic Profile</h3>
                </div>
                <div class="text-right col-sm-8 col-9 m-b-20">
                    <a href="{{ route('edit_clinic_profile', $clinic->id) }}" class="float-right btn btn-primary btn-rounded" style="font-weight: bold;"> <i class="fa fa-edit"></i> Edit Profile</a>
                </div>
            </div>
        </div>
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body">

                <div class="text-center mb-4">
                    <img src="{{ asset('assets/img/logo-dark.png') }}"
                         alt="Clinic Logo"
                         class="rounded-circle border border-3 border-light shadow-sm"
                         width="120" height="120">
                    <h2 class="fw-bold mt-3 mb-1">{{ $clinic->name }}</h2>
                    <p class="text-muted mb-0"><i class="fa fa-map-marker-alt"></i> {{ $clinic->location }}</p>
                </div>

                <hr>

                <div class="row text-start">
                    <div class="col-md-6 mb-3">
                        <div class="p-3 rounded d-flex align-items-center shadow-sm" style="background-color: #ebeaea;">
                            <span class="badge bg-danger p-3 rounded-circle me-4">
                                <i class="fa fa-envelope text-white fa-lg"></i>
                            </span>
                            <div>
                                <span class="fw-bold text-dark">&nbsp;&nbsp; Email</span><br>
                                <span class="text-dark">&nbsp;&nbsp; {{ $clinic->email }}</span>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-md-6 mb-3">
                        <div class="p-3 rounded d-flex align-items-center shadow-sm" style="background-color: #ebeaea;">
                            <span class="badge bg-success p-3 rounded-circle me-4">
                                <i class="fa fa-phone text-white fa-lg"></i>
                            </span>
                            <div>
                                <span class="fw-bold text-dark">&nbsp;&nbsp; Phone</span><br>
                                <span class="text-dark">&nbsp;&nbsp; {{ $clinic->phone }}</span>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-md-6 mb-3">
                        <div class="p-3 rounded d-flex align-items-center shadow-sm" style="background-color: #ebeaea;">
                            <span class="badge bg-warning p-3 rounded-circle me-4">
                                <i class="fa fa-clock text-white fa-lg"></i>
                            </span>
                            <div>
                                <span class="fw-bold text-dark">&nbsp;&nbsp; Working Hours</span><br>
                                <span class="text-dark">&nbsp;&nbsp; {{ $clinic->work_start }} - {{ $clinic->work_end }}</span>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-md-6 mb-3">
                        <div class="p-3 rounded d-flex align-items-center shadow-sm" style="background-color: #ebeaea;">
                            <span class="badge bg-primary p-3 rounded-circle me-4">
                                <i class="fa fa-calendar text-white fa-lg"></i>
                            </span>
                            <div>
                                <span class="fw-bold text-dark">&nbsp;&nbsp; Working Days</span><br>
                                <span class="text-dark">&nbsp;&nbsp; {{ implode(', ', $clinic->work_days) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <div class="card-body" style="background-color: #ebeaea;">
                        <h4 class="fw-bold mb-3 d-flex align-items-center" style="font-size: 20px;">
                            <i class="fas fa-align-left me-3 text-primary" style="font-size: 22px;"></i>
                            &nbsp;&nbsp; About the Clinic
                        </h4>
                        <p class="mb-0" style="font-size: 15px; color: #333;">
                            {{ $clinic->description ? $clinic->description : 'No Description Available Yet' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3 d-flex justify-content-end">
            <a href="{{ Route('dashboard') }}" class="btn btn-primary rounded-pill" style="font-weight: bold;">
                Back
            </a>
        </div>
    </div>
</div>
@endsection
