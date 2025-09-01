@extends('Backend.employees.store_supervisors.master')

@section('title' , 'Request Rejection')

@section('content')

<style>
    .col-sm-6 { margin-bottom: 20px; }
    .card + .card { margin-top: 20px; }
    input[type="time"] { direction: ltr; text-align: left; }

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
                <h4 class="page-title" style="margin-bottom: 30px;">Request Rejection</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form id="rejectForm">
                    @csrf

                    <div class="card">
                        <div class="card-header">Reason</div>
                        <div class="card-body">
                            <div class="col-sm-12" style="margin-top: 20px;">
                                <textarea class="form-control" style="margin-bottom: 20px;" id="note" name="note" rows="5" placeholder="Enter The Reason"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="text-center" style="margin-top:20px;">
                        <button type="submit" class="px-5 btn btn-primary submit-btn addBtn rounded-pill" style="text-transform: none !important;">
                            Reject
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
        $('#rejectForm').on('submit', function(e) {
            e.preventDefault();

            let note = $('#note').val();

            $.ajax({
                method: 'POST',
                url: "{{ route('medication_request_reject', $request->id) }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    note: note
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Rejected',
                            text: 'The Request Has Been Rejected Successfully',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = "{{ route('view_requests') }}";
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Something went wrong. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });
</script>
@endsection

