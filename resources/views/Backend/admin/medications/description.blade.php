@extends('Backend.master')

@section('title', 'Medication Details')

@section('content')

<div class="page-wrapper">
    <div class="content">
        <div class="mb-4 row">
            <div class="col-sm-12">
                <h4 class="page-title">Medication Details</h4>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-8 col-sm-12">
                <div class="mb-4 shadow-sm card rounded-3">
                    <div class="px-3 py-2 text-white card-header bg-primary" style="font-size: 15px;">
                        <i class="fas fa-info-circle me-2 text-white"></i>
                        <span class="fw-semibold" style="font-weight: bold;">General Information</span>
                    </div>

                    <table class="table mb-0 table-borderless">
                        <tr>
                            <th style="width: 200px;">
                                <i class="fas fa-capsules me-2 text-primary"></i>
                                <span class="fw-semibold">Name:</span>
                            </th>
                            <td class="ps-4">{{ $medication->name }}</td>
                        </tr>

                        <tr>
                            <th>
                                <i class="fas fa-vial me-2 text-primary"></i>
                                <span class="fw-semibold">Dosage Form:</span>
                            </th>
                            <td class="ps-4">{{ $medication->dosage_form }}</td>
                        </tr>

                        <tr>
                            <th>
                                <i class="fas fa-tags me-2 text-primary"></i>
                                <span class="fw-semibold">Category:</span>
                            </th>
                            <td class="ps-4">{{ $medication->category }}</td>
                        </tr>

                        <tr>
                            <th>
                                <i class="fas fa-calendar-alt me-2 text-primary"></i>
                                <span class="fw-semibold">Expiry Date:</span>
                            </th>
                            <td class="ps-4">{{ $medication->expiry_date }}</td>
                        </tr>

                        <tr>
                            <th>
                                <i class="fas fa-dollar-sign me-2 text-primary"></i>
                                <span class="fw-semibold">Selling Price:</span>
                            </th>
                            <td class="ps-4">${{ $medication->selling_price }}</td>
                        </tr>

                        <tr>
                            <th>
                                <i class="fas fa-check-circle me-2 text-primary"></i>
                                <span class="fw-semibold">Status:</span>
                            </th>
                            <td class="ps-4">
                                @if($medication->status === 'Valid')
                                    <span style="padding: 6px 20px; font-size: 15px; border-radius: 20px; background-color: #13ee29; color: white; font-weight: bold;">
                                        Valid
                                    </span>
                                @else
                                    <span style="padding: 6px 20px; font-size: 15px; border-radius: 20px; background-color: #f90d25; color: white; font-weight: bold;">
                                        Expired
                                    </span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- وصف -->
                <div class="shadow-sm card rounded-3">
                    <div class="px-3 py-2 text-white card-header bg-primary" style="font-size: 15px;">
                        <i class="fas fa-align-left me-2"></i>
                        <span class="fw-semibold" style="font-weight: bold;">Description</span>
                    </div>
                    <div class="card-body bg-light">
                        <p class="mb-0" style="font-size: 15px; color: #333;">
                            {{ $medication->description ?: 'No notes at the moment' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 row" style="margin-left: 450px;">
            <div class="col-lg-6 offset-lg-2 d-flex justify-content-end">
                <a href="{{ route('view_medications') }}" class="px-4 btn btn-primary rounded-pill fw-bold" style="font-weight: bold;">
                    Back
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
