@extends('Backend.departments_managers.master')

@section('title' , 'Department Manager Dashboard')

@section('content')

<div class="page-wrapper">
    <div class="content">
        <div class="row">

            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="dash-widget">
                    <span class="dash-widget-bg4"><i class="fas fa-stethoscope" aria-hidden="true"></i></span>
                    <div class="text-right dash-widget-info">
                        <h3>{{ $specialty_count }}</h3>
                        <span class="widget-title4">Specialties <i class="fa fa-check" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="dash-widget">
                    <span class="dash-widget-bg3" style="background-color: #6f42c1;"><i class="fas fa-user" aria-hidden="true"></i></span>
                    <div class="text-right dash-widget-info">
                        <h3>{{ $employee_count }}</h3>
                        <span class="widget-title3" style="background-color: #6f42c1;">Employees <i class="fa fa-check" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="dash-widget">
                    <span class="dash-widget-bg2"><i class="fa fa-user-md"></i></span>
                    <div class="text-right dash-widget-info">
                        <h3>{{ $doctor_count }}</h3>
                        <span class="widget-title2">Doctors <i class="fa fa-check" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="dash-widget">
                    <span class="dash-widget-bg3"><i class="fas fa-user-injured" aria-hidden="true"></i></span>
                    <div class="text-right dash-widget-info">
                        <h3>{{ $patient_count }}</h3>
                        <span class="widget-title3">Patients <i class="fa fa-check" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>

            {{-- <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="dash-widget">
                    <span class="dash-widget-bg3" style="background-color: #e83e8c;"><i class="fas fa-capsules" aria-hidden="true"></i></span>
                    <div class="text-right dash-widget-info">
                        <h3>{{ $medication_count }}</h3>
                        <span class="widget-title3" style="background-color: #e83e8c;">Medications <i class="fa fa-check" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="dash-widget">
                    <span class="dash-widget-bg3" style="background-color: #814e34;"><i class="fas fa-warehouse" aria-hidden="true"></i></span>
                    <div class="text-right dash-widget-info">
                        <h3>{{ $medicine_stock_count }}</h3>
                        <span class="widget-title3" style="background-color: #814e34;">Service <i class="fa fa-check" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="dash-widget">
                    <span class="dash-widget-bg2" style="background-color: #6f42c1;"><i class="fas fa-calendar-check"></i></span>
                    <div class="text-right dash-widget-info">
                        <h3>{{ $today_appointments }}</h3>
                        <span class="widget-title2" style="background-color: #6f42c1;">Today Appointments <i class="fa fa-check" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div> --}}

        </div>
@endsection
