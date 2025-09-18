@if($insurances_providers->count() > 0)
    @foreach ($insurances_providers as $insurance_provider)
        <tr>
            <td>{{ $insurance_provider->id }}</td>
            <td>{{ $insurance_provider->name }}</td>
            <td>{{ $insurance_provider->email }}</td>
            <td>{{ $insurance_provider->phone }}</td>
            <td>{{ $insurance_provider->representative_name }}</td>
            <td>
                @if($insurance_provider->status === 'active')
                    <span class="status-badge" style="padding: 6px 24px; font-size: 18px; border-radius: 50px; background-color: #13ee29; color: white;">Active</span>
                @else
                    <span class="status-badge" style="padding: 6px 20px; font-size: 18px; border-radius: 50px; background-color: #f90d25; color: white;">Inactive</span>
                @endif
            </td>
            <td class="action-btns">
                <div class="d-flex justify-content-center">
                    <a href="{{ route('details_insurance_provider', ['id' => $insurance_provider->id]) }}" class="mr-1 btn btn-outline-success btn-sm"><i class="fa fa-eye"></i></a>
                    <a href="{{ route('edit_insurance_provider', ['id' => $insurance_provider->id]) }}" class="mr-1 btn btn-outline-primary btn-sm"><i class="fa fa-edit"></i></a>
                    <button class="btn btn-outline-danger btn-sm delete-insurance-provider" data-id="{{ $insurance_provider->id }}"><i class="fa fa-trash"></i></button>
                </div>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="7" class="p-4 text-center">
            <strong style="font-size: 18px; color: gray;">No Insurance Providers Found</strong>
        </td>
    </tr>
@endif
