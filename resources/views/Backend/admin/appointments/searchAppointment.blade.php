@if($appointments->count() > 0)
    @foreach ($appointments as $appointment)
    <tr>
        <td>{{ $appointment->id }}</td>
        <td>{{ $appointment->patient->user->name }}</td>
        <td>{{ $appointment->department->name }}</td>
        <td>{{ $appointment->doctor->user->name }}</td>
        <td>{{ $appointment->date }}</td>
        <td>{{ $appointment->time }}</td>
        <td>
            @if($appointment->status === 'Pending')
                <span class="status-badge" style="min-width: 140px; display:inline-block; text-align:center; padding:4px 12px; font-size:18px; border-radius:50px; background-color:#ffc107; color:white;">
                    Pending
                </span>
            @elseif($appointment->status === 'Accepted')
                <span class="status-badge" style="min-width: 140px; display:inline-block; text-align:center; padding:4px 12px; font-size:18px; border-radius:50px; background-color:#189de4; color:white;">
                    Accepted
                </span>
            @elseif($appointment->status === 'Rejected')
                <span class="status-badge" style="min-width: 140px; display:inline-block; text-align:center; padding:4px 12px; font-size:18px; border-radius:50px; background-color:#6c757d; color:white;">
                    Rejected
                </span>
            @elseif($appointment->status === 'Cancelled')
                <span class="status-badge" style="min-width: 140px; display:inline-block; text-align:center; padding:4px 12px; font-size:18px; border-radius:50px; background-color:#f90d25; color:white;">
                    Cancelled
                </span>
            @elseif($appointment->status === 'Completed')
                <span class="status-badge" style="min-width: 140px; display:inline-block; text-align:center; padding:4px 12px; font-size:18px; border-radius:50px; background-color:#15ef70; color:white;">
                    Completed
                </span>
            @endif
        </td>
        <td class="action-btns">
            <div class="d-flex justify-content-center">
                <a href="{{ route('description_appointment', ['id' => $appointment->id]) }}" class="mr-1 btn btn-outline-success btn-sm"><i class="fa fa-eye"></i></a>
                <a href="{{ route('edit_appointment', ['id' => $appointment->id]) }}" class="mr-1 btn btn-outline-primary btn-sm"><i class="fa fa-edit"></i></a>
                <button class="btn btn-outline-danger btn-sm delete-appointment" data-id="{{ $appointment->id }}"><i class="fa fa-trash"></i></button>
            </div>
        </td>
    </tr>
    @endforeach
@else
    <tr>
        <td colspan="9" class="p-4 text-center">
            <strong style="font-size: 18px; color: gray;">No Appointments Found</strong>
        </td>
    </tr>
@endif



