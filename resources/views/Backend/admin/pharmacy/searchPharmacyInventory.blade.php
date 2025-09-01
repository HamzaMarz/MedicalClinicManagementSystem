@if($medications->count() > 0)
    @foreach ($medications as $med)
        <tr>
            <td>{{ $med->id }}</td>
            <td>{{ $med->medication->name }}</td>
            <td>{{ $med->quantity }}</td>
            <td>{{ $med->medication->expiry_date }}</td>
            <td>
                @if($med->medication->status === 'Valid')
                    <span class="status-badge" style="padding: 6px 24px; font-size: 18px; border-radius: 50px; background-color: #13ee29; color: white;">Valid</span>
                @else
                    <span class="status-badge" style="padding: 6px 20px; font-size: 18px; border-radius: 50px; background-color: #f90d25; color: white;">Expired</span>
                @endif
            </td>
            <td>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('description_medication', $med->id) }}" class="mr-1 btn btn-outline-success btn-sm"><i class="fa fa-eye"></i></a>
                    <a href="{{ route('edit_medication', $med->id) }}" class="mr-1 btn btn-outline-primary btn-sm"><i class="fa fa-edit"></i></a>
                    <button class="btn btn-outline-danger btn-sm delete-medication-pharmacy" data-id="{{ $med->id }}">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="6" class="p-4 text-center">
            <strong style="font-size: 18px; color: gray;">No Medications Found</strong>
        </td>
    </tr>
@endif
