@if($patients_insurances->count() > 0)
    @foreach ($patients_insurances as $insurance)
        <tr>
            <td>{{ $insurance->id }}</td>
            <td>{{ $insurance->patient->user->name }}</td>
            <td>{{ $insurance->provider->name }}</td>
            <td>{{ $insurance->coverage_percentage }}%</td>
            <td>{{ $insurance->start_date }}</td>
            <td>{{ $insurance->end_date }}</td>
            <td class="action-btns">
                <div class="d-flex justify-content-center">
                    <a href="{{ route('edit_patient_insurance', $insurance->id) }}" class="mr-1 btn btn-outline-primary btn-sm"><i class="fa fa-edit"></i></a>
                    <button class="btn btn-outline-danger btn-sm delete-patient-insurance" data-id="{{ $insurance->id }}"><i class="fa fa-trash"></i></button>
                </div>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="7" class="p-4 text-center">
            <strong style="font-size: 18px; color: gray;">No Patient Insurances Found</strong>
        </td>
    </tr>
@endif
