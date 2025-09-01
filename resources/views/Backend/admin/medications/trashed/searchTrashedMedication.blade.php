@if($medications->count() > 0)
    @foreach ($medications as $medication)
        <tr>
            <td>{{ $medication->id }}</td>
            <td>{{ $medication->name }}</td>
            <td>{{ $medication->dosage_form }}</td>
            <td>{{ $medication->category }}</td>
            <td>
                @if($medication->status === 'Valid')
                    <span class="status-badge" style="padding: 6px 24px; font-size: 18px; border-radius: 50px; background-color: #13ee29; color: white;">Valid</span>
                @else
                    <span class="status-badge" style="padding: 6px 20px; font-size: 18px; border-radius: 50px; background-color: #f90d25; color: white;">Expired</span>
                @endif
            </td>
            <td class="action-btns">
                <div class="d-flex justify-content-center">
                    <button class="btn btn-outline-primary btn-sm restore-medication mr-1" data-id="{{ $medication->id }}">
                        <i class="fa fa-undo"></i>
                    </button>

                    <button class="btn btn-outline-danger btn-sm delete-medication" data-id="{{ $medication->id }}">
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
