@extends('Backend.employees.store_supervisors.master')

@section('title' , 'Request Description')

@section('content')
<style>
    .section-header {
        background-color: #00aaff;
        color: #fff;
        font-weight: bold;
        padding: 12px 20px;
        border-radius: 5px 5px 0 0;
        margin-bottom: 0;
        box-shadow: none !important;
        font-size: 16px;
    }
</style>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-8 offset-md-2">

                <h4 class="mb-3 font-weight-bold">Request Details</h4>

                <div class="section-header">
                    Requested By Admin
                </div>

                <!-- الكرت الأساسي -->
                <div class="card border-0 rounded-lg">
                    <div class="card-body p-4">

                        <!-- Medication & Quantity -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5 class="text-muted mb-2">Medication Name</h5>
                                <p class="font-weight-bold text-dark" style="font-size: 18px;">
                                    {{ $request->medication->name }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h5 class="text-muted mb-2">Requested Quantity</h5>
                                <p class="font-weight-bold text-dark" style="font-size: 18px;">
                                    {{ $request->requested_quantity }}
                                </p>
                            </div>
                        </div>

                        <!-- Status & Date -->
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="text-muted mb-2">Request Date</h5>
                                <p class="font-weight-bold text-dark" style="font-size: 18px;">
                                    {{ $request->created_at->format('d M Y - h:i A') }}
                                </p>
                            </div>

                            <div class="col-md-6">
                                <h5 class="text-muted mb-2">Status</h5>
                                @if($request->status === 'pending')
                                    <span class="status-badge" style="padding: 6px 24px; font-size: 18px; border-radius: 50px; background-color: #f5a623; color: white;">
                                        Pending
                                    </span>
                                @elseif($request->status === 'approved')
                                    <span class="status-badge" style="padding: 6px 24px; font-size: 18px; border-radius: 50px; background-color: #13ee29; color: white;">
                                        Approved
                                    </span>
                                @elseif($request->status === 'rejected')
                                    <span class="status-badge" style="padding: 6px 24px; font-size: 18px; border-radius: 50px; background-color: #f90d25; color: white;">
                                        Rejected
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>


                <!-- كرت المشرف المنفذ يظهر فقط لو الطلب مش Pending -->
                @if($request->status !== 'pending' && $request->supervisor)
                    <div class="section-header mt-4">
                        Execution
                    </div>
                    <div class="card border-0 rounded-lg">
                        <div class="card-body p-4 d-flex justify-content-between align-items-center">

                            <!-- اسم المشرف -->
                            <div class="col-md-6">
                                <h5 class="text-muted mb-2">Supervisor Name</h5>
                                <p class="font-weight-bold text-dark" style="font-size: 18px;">
                                    {{ $request->supervisor->name }}
                                </p>
                            </div>


                            <!-- تاريخ التنفيذ -->
                            <div class="col-md-6">
                                <h5 class="text-muted mb-2">Request Date</h5>
                                <p class="font-weight-bold text-dark" style="font-size: 18px;">
                                    {{ $request->updated_at->format('d M Y - h:i A') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif


                <!-- كرت الملاحظات يظهر فقط عند الرفض -->
                @if($request->status === 'rejected')
                    <div class="section-header mt-4">
                        Rejection Notes
                    </div>
                    <div class="card border-0 rounded-lg">
                        <div class="card-body p-4">
                            <p class="font-weight-bold text-dark" style="font-size: 18px;">
                                {{ $request->note ?? 'No notes provided.' }}
                            </p>
                        </div>
                    </div>
                @endif

                <!-- زر العودة -->
                <div class="row mt-4">
                    <div class="col text-right">
                        <a href="{{ Route('store_supervisor_dashboard') }}"
                           class="btn btn-primary px-4 py-2 rounded-pill font-weight-bold shadow-sm">
                            Back
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
