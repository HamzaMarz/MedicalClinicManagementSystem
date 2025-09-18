@extends('Backend.admin.master')

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

                <h4 class="mb-3 font-weight-bold">Request Description</h4>

                <div class="section-header">
                    Request Details
                </div>

                <div class="border-0 rounded-lg card">
                    <div class="p-4 card-body">

                        <div class="mb-4 row">
                            <div class="col-md-6">
                                <h5 class="mb-2 text-muted">Medication Name</h5>
                                <p class="font-weight-bold text-dark" style="font-size: 18px;">
                                    {{ $request->medication->name }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h5 class="mb-2 text-muted">Requested Quantity</h5>
                                <p class="font-weight-bold text-dark" style="font-size: 18px;">
                                    {{ $request->requested_quantity }}
                                </p>
                            </div>
                        </div>

                        <!-- Status & Date -->
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-2 text-muted">Request Date</h5>
                                <p class="font-weight-bold text-dark" style="font-size: 18px;">
                                    {{ $request->created_at->format('d M Y - h:i A') }}
                                </p>
                            </div>

                            <div class="col-md-6">
                                <h5 class="mb-2 text-muted">Status</h5>
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
                    <div class="mt-4 section-header">
                        Execution
                    </div>
                    <div class="border-0 rounded-lg card">
                        <div class="p-4 card-body d-flex justify-content-between align-items-center">

                            <!-- اسم المشرف -->
                            <div class="col-md-6">
                                <h5 class="mb-2 text-muted">Supervisor Name</h5>
                                <p class="font-weight-bold text-dark" style="font-size: 18px;">
                                    {{ $request->supervisor->name }}
                                </p>
                            </div>


                            <!-- تاريخ التنفيذ -->
                            <div class="col-md-6">
                                <h5 class="mb-2 text-muted">Request Date</h5>
                                <p class="font-weight-bold text-dark" style="font-size: 18px;">
                                    {{ $request->updated_at->format('d M Y - h:i A') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif


                <!-- كرت الملاحظات يظهر فقط عند الرفض -->
                @if($request->status === 'rejected')
                    <div class="mt-4 section-header">
                        Rejection Notes
                    </div>
                    <div class="border-0 rounded-lg card">
                        <div class="p-4 card-body">
                            <p class="font-weight-bold text-dark" style="font-size: 18px;">
                                {{ $request->note ?? 'No notes provided.' }}
                            </p>
                        </div>
                    </div>
                @endif

                <!-- زر العودة -->
                <div class="mt-4 row">
                    <div class="text-right col">
                        <a href="{{ Route('dashboard') }}"
                           class="px-4 py-2 shadow-sm btn btn-primary rounded-pill font-weight-bold">
                            Back
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
