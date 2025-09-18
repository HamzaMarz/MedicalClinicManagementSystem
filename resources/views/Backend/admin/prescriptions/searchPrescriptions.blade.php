@if($prescriptions->count() > 0)
    @foreach ($prescriptions as $prescription)
        <tr>
            <td>{{ $prescription->id }}</td>
            <td>#APP_{{ $prescription->appointment->id }}</td>
            <td>{{ $prescription->patient->user->name }}</td>
            <td>{{ $prescription->appointment->department->name }}</td>
            <td>{{ $prescription->doctor->employee->user->name }}</td>
            <td class="action-btns">
                <div class="d-flex justify-content-center">
                    <a href="{{ route('description_prescription', ['id' => $prescription->id]) }}"
                       class="mr-1 btn btn-outline-success btn-sm">
                        <i class="fa fa-eye"></i>
                    </a>
                    <button class="btn btn-outline-danger btn-sm delete-prescription"
                            data-id="{{ $prescription->id }}">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="6" class="p-4 text-center">
            <strong style="font-size: 18px; color: gray;">No Prescriptions Found</strong>
        </td>
    </tr>
@endif
