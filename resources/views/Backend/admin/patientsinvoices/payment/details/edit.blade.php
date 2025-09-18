@extends('Backend.admin.master')

@section('title' , 'Edit Patient Payment Details')

@section('content')
<style>
    .col-sm-6 { margin-bottom: 20px; }
    input[type="date"] { direction: ltr; text-align: left; }
    .card { border: 1px solid #ddd !important; border-radius: 8px !important; box-shadow: 0 4px 10px rgba(0,0,0,0.08) !important; overflow: hidden !important; }
    .card-header { background-color: #00A8FF !important; color: #fff !important; font-weight: 600 !important; padding: 12px 15px !important; font-size: 16px !important; border-bottom: 1px solid #ddd !important; }
    .card-body { background-color: #fff; padding: 20px; }
</style>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title" style="margin-bottom:30px;">Edit Patient Payment Details</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form method="POST" action="{{ Route('update_payment_details' , ['id' => $payment_detail->id]) }}">
                    @csrf
                    @method('PUT')

                    {{-- 1) Payment Information --}}
                    <div class="card">
                        <div class="card-header">Payment Information</div>
                        <div class="card-body">
                            <div class="row">
                                {{-- Amount Paid --}}
                                <div class="col-sm-6">
                                    <label>Amount Paid <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-money-bill"></i></span></div>
                                        <input class="form-control" type="number" id="amount_paid" name="amount_paid" value="{{ $payment_detail->amount_paid }}">
                                    </div>
                                </div>

                                {{-- Payment Method --}}
                                <div class="col-sm-6">
                                    <label>Payment Method <span class="text-danger">*</span></label>
                                    <div class="card p-2">
                                        @php
                                            $methods = [
                                                'cash' => 'Cash',
                                                'credit_card' => 'Credit Card',
                                                'bank_transfer' => 'Bank Transfer',
                                                'insurance' => 'Insurance'
                                            ];
                                        @endphp
                                        @foreach($methods as $value => $label)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="payment_method" id="payment_{{ $value }}" value="{{ $value }}"
                                                    {{ old('payment_method', $payment_detail->payment_method ?? '') == $value ? 'checked' : '' }}>
                                                <label class="form-check-label" for="payment_{{ $value }}">{{ $label }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- Payment Date --}}
                                <div class="col-sm-6 mt-3">
                                    <label>Payment Date <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-calendar-check"></i></span></div>
                                        <input class="form-control" type="date" id="payment_date" name="payment_date" value="{{ \Carbon\Carbon::parse($payment_detail->payment_date)->format('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 2) Notes --}}
                    <div class="card">
                        <div class="card-header">Additional Notes</div>
                        <div class="card-body">
                            <div class="form-group">
                                <textarea class="form-control" id="notes" name="notes" rows="3">{{ $payment_detail->notes }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="text-center" style="margin-top:20px;">
                        <button type="submit" class="btn btn-primary submit-btn addBtn" style="text-transform:none !important;">Edit Patient Payment Details</button>
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
        $('.addBtn').click(function (e) {
            e.preventDefault();
            let payment_id = {{ $payment_detail->payment_id }};
            let amount_paid = $('#amount_paid').val().trim();
            let payment_method = $('input[name="payment_method"]:checked').val();
            let payment_date = $('#payment_date').val().trim();
            let notes = $('#notes').val().trim();

            let formData = new FormData();
            formData.append('_method', 'PUT');
            formData.append('amount_paid', amount_paid);
            formData.append('payment_method', payment_method);
            formData.append('payment_date', payment_date);
            formData.append('notes', notes);

            if (amount_paid === '' || !payment_method || payment_date === '') {
                Swal.fire({ title: 'Error!', text: 'Please Enter All Required Fields', icon: 'error' });
                return;
            }

            $.ajax({
                method: 'POST',
                url: "{{ route('update_payment_details', ['id' => $payment_detail->id]) }}",
                data: formData,
                processData: false,
                contentType: false,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    if (response.data == 0) {
                        Swal.fire({ title: 'Error!',
                        text: 'The Patient Payment Details Has Already Been Booked',
                        icon: 'error'
                    });
                    } else if (response.data == 1) {
                        Swal.fire({
                            title: 'Success',
                            text: 'Patient Payment Detail Has Been Updated Successfully',
                            icon: 'success'
                        }).then(() => {
                            window.location.href = '/admin/details/patient/invoice/payment/' + payment_id;
                        });
                    }
                }
            });
        });
    });
</script>
@endsection
