@extends('Backend.admin.master')

@section('title' , 'View Prescription Items')

@section('content')
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        .page-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .pagination-wrapper {
            margin-top: auto;
            padding-top: 80px; /* مسافة من الجدول */
            padding-bottom: 30px;
        }

    </style>

    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-4 col-3">
                    <h4 class="page-title">View Prescription Items</h4>
                    <h4 style="margin-top: 30px; color:black;">Prescription ID: {{ $prescription_items->first()->prescription_id ?? '-' }}</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table mb-0 text-center table-bordered table-striped custom-table">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Medicine Name</th>
                                    <th>Frequency</th>
                                    <th>Duration</th>
                                    <th>Instructions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($prescription_items->count() > 0)
                                    @foreach ($prescription_items as $prescription_item)
                                        <tr>
                                            <td>{{ $prescription_item->id }}</td>
                                            <td>{{ $prescription_item->medications->name }}</td>
                                            <td>{{ $prescription_item->frequency }}</td>
                                            <td>{{ $prescription_item->duration }}</td>
                                            <td>{{ $prescription_item->instructions }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <div style="font-weight: bold; font-size: 18px; margin-top:15px;">
                                                No Prescription Items Available At The Moment
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
