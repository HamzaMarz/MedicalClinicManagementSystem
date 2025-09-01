@extends('Backend.employees.store_supervisors.master')

@section('title' , 'Request Description')

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-8 offset-md-2">

                <div class="border-0 rounded-lg shadow-lg card">
                    <div class="text-white card-header bg-primary d-flex justify-content-between align-items-center">
                        <h4 class="mb-0"><i class="fa fa-info-circle"></i> Request Details</h4>
                        {{-- <span class="badge badge-light" style="font-size:14px;">
                            Request #{{ $request->id }}
                        </span> --}}
                    </div>

                    <div class="p-4 card-body">
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <h6 class="text-muted">Medication Name</h6>
                                <p class="font-weight-bold">{{ $request->medication->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Requested Quantity</h6>
                                <p class="font-weight-bold">{{ $request->requested_quantity }}</p>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <h6 class="text-muted">Requested By</h6>
                                <p class="font-weight-bold">Admin</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Status</h6>
                                @if($request->status === 'pending')
                                    <span class="px-3 py-2 badge badge-warning">Pending</span>
                                @elseif($request->status === 'approved')
                                    <span class="px-3 py-2 badge badge-success">Approved</span>
                                @elseif($request->status === 'rejected')
                                    <span class="px-3 py-2 badge badge-danger">Rejected</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-12">
                                <h6 class="text-muted">Request Date</h6>
                                <p class="font-weight-bold">{{ $request->created_at->format('d M Y - h:i A') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="text-right card-footer">
                        <a href="{{ route('store_supervisor_dashboard') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
