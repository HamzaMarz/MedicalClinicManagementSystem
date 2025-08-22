@extends('Backend.master')

@section('title' , 'Doctors Schedules')

@section('content')
    <style>
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
        .table th {
            white-space: nowrap;
            font-size: 12px;
        }
        .fw-bold {
            font-weight: bold;
        }
    </style>

<div class="page-wrapper">
    <div class="content">
        <div>
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Search Doctors Schedules</h4>
            </div>
            <div class="card-body" style="margin-top: 50px;">
                <form id="doctor-schedule-form" method="POST" action="{{ route('search_doctor_schedules') }}">
                    @csrf
                    <div class="mb-3 row">

                        <div class="col-md-4">
                            <label><i class="fas fa-stethoscope text-primary"></i> Department</label>
                            <select class="form-control" name="department_id" id="department_id" required>
                                <option value="" disabled {{ !isset($department_id) ? 'selected' : '' }} hidden>Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" {{ (isset($department_id) && $department_id == $department->id) ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label><i class="fas fa-user-md text-primary"></i> Doctor</label>
                            <select class="form-control" name="doctor_id" id="doctor_id" required>
                                <option value="" disabled {{ !isset($doctor_id) ? 'selected' : '' }} hidden>Select Doctor</option>
                                @if(isset($doctors))
                                    @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->id }}" {{ (isset($doctor_id) && $doctor_id == $doctor->id) ? 'selected' : '' }}>
                                            {{ $doctor->employee->user->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <input type="hidden" name="offset" id="week_offset" value="{{ $offset ?? 0 }}">

                    <div class="text-right" style="margin-top: 30px;">
                        <button type="submit" class="px-4 btn btn-success"><i class="mr-2 fa fa-search"></i>Search</button>
                    </div>
                </form>

                @if(isset($selectedDoctor))
                <div class="mt-4 border-0 shadow-sm card">

                    {{-- العنوان الثابت --}}
                    <div class="text-white card-header bg-primary d-flex justify-content-between align-items-center rounded-top">
                        <h5 class="mb-0">Weekly Schedule for Dr. {{ $selectedDoctor->employee->user->name }}</h5>
                    </div>

                    <div class="p-3 card-body">

                        {{-- ✅ أزرار التنقل والتاريخ --}}
                        <div class="p-3 mb-3 border rounded shadow-sm d-flex justify-content-between align-items-center bg-light">
                            <button type="button" onclick="changeWeek(-1)" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-chevron-left"></i> Previous Week
                            </button>

                            <div class="text-center fw-semibold text-dark w-100" style="font-weight: bold;">
                                Week:
                                <span>{{ $startOfWeek->format('d/m/Y') }}</span>
                                –
                                <span>{{ $endOfWeek->format('d/m/Y') }}</span>

                                @if ($offset === 0)
                                    <div class="mt-1 text-success" style="font-size: 14px;">
                                        Current Week
                                    </div>
                                @endif
                            </div>

                            <button type="button" onclick="changeWeek(1)" class="btn btn-outline-primary btn-sm">
                                Next Week <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>

                        {{-- ✅ جدول المواعيد --}}
                        <div class="table-responsive">
                            <table class="table mb-0 text-center align-middle table-bordered" style="min-width: 1000px; font-size: 14px;">
                                @php
                                    $startTime = \Carbon\Carbon::parse($selectedDoctor->employee->work_start_time);
                                    $endTime = \Carbon\Carbon::parse($selectedDoctor->employee->work_end_time);
                                    $timeSlots = [];

                                    while ($startTime <= $endTime) {
                                        $timeSlots[] = $startTime->format('H:i:s');
                                        $startTime->addMinutes(30);
                                    }

                                    $workingDays = is_string($selectedDoctor->employee->working_days)
                                        ? json_decode($selectedDoctor->employee->working_days)
                                        : $selectedDoctor->employee->working_days;

                                    $appointmentsGrouped = $appointments->groupBy(function($a) {
                                        return \Carbon\Carbon::parse($a->date)->format('l') . '-' . $a->time;
                                    });
                                @endphp

                                <thead class="table-light">
                                    <tr>
                                        <th style="min-width: 110px;">Day / Time</th>
                                        @foreach ($timeSlots as $slot)
                                            <th style="min-width: 70px;">{{ \Carbon\Carbon::parse($slot)->format('H:i') }}</th>
                                        @endforeach
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($workingDays as $day)
                                        <tr>
                                            <td class="fw-bold bg-light text-dark">{{ $day }}</td>

                                            @foreach ($timeSlots as $slot)
                                                @php
                                                    $key = $day . '-' . $slot;
                                                @endphp
                                                <td>
                                                    @if(isset($appointmentsGrouped[$key]))
                                                        <span class="text-success" style="font-size: 22px;">&#10004;</span>
                                                    @else
                                                        <span class="text-muted" style="font-size: 16px;">–</span>
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')
<script>
    // عند تغيير القسم: حمّل الأطباء لهذا القسم فقط
    $('#department_id').on('change', function () {
        var departmentId = $(this).val();

        let doctorSelect = $('#doctor_id');
        doctorSelect.prop('disabled', false).empty() // ✅ خليها مفعلة من البداية
            .append('<option value="" disabled selected hidden>Select Doctor</option>');

        if (departmentId) {
            $.ajax({
                url: '/admin/get-doctors-by-department/' + departmentId,
                type: 'GET',
                success: function (data) {
                    if (data.length > 0) {
                        $.each(data, function (key, doctor) {
                            doctorSelect.append('<option value="' + doctor.id + '">' + doctor.name + '</option>');
                        });
                    } else {
                        doctorSelect.append('<option value="" disabled>No doctors found</option>');
                    }
                },
            });
        }
    });

    // إخفاء خيار "Select Doctor" عند الاختيار
    $('#doctor_id').on('change', function () {
        $(this).find('option:first').hide();
    });

    function changeWeek(direction) {
        $('#department_id, #doctor_id').prop('disabled', false);

        var form        = document.getElementById('doctor-schedule-form');
        var offsetField = document.getElementById('week_offset');

        if (!offsetField) {
            offsetField       = document.createElement('input');
            offsetField.type  = 'hidden';
            offsetField.name  = 'offset';
            offsetField.id    = 'week_offset';
            offsetField.value = '0';
            form.appendChild(offsetField);
        }

        var current = parseInt(offsetField.value || '0', 10);
        offsetField.value = (isNaN(current) ? 0 : current) + Number(direction);

        form.submit();
    }
</script>
@endsection
