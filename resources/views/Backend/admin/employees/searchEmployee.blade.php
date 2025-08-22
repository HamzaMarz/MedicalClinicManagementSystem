@if($employees->count() > 0)
    @foreach ($employees as $employee)
        <tr>
            <td>{{ $employee->id }}</td>
            <td>{{ $employee->user->name }}</td>
            <td>{{ $employee->department->name }}</td>
            <td>{{ $employee->jobTitles->pluck('name')->implode(' , ') }}</td>
            <td>{{ $employee->user->email }}</td>
            <td>{{ $employee->user->phone }}</td>
            <td>
                @if($employee->status === 'active')
                    <span class="status-badge" style="padding: 6px 24px; font-size: 18px; border-radius: 50px; background-color: #13ee29; color: white;">Active</span>
                @else
                    <span class="status-badge" style="padding: 6px 20px; font-size: 18px; border-radius: 50px; background-color: #f90d25; color: white;">Inactive</span>
                @endif
            </td>
            <td class="action-btns">
                <div class="d-flex justify-content-center">
                    <a href="{{ route('profile_employee', ['id' => $employee->id]) }}" class="mr-1 btn btn-outline-success btn-sm"><i class="fa fa-eye"></i></a>
                    <a href="{{ route('edit_employee', ['id' => $employee->id]) }}" class="mr-1 btn btn-outline-primary btn-sm"><i class="fa fa-edit"></i></a>
                    <button class="btn btn-outline-danger btn-sm delete-employee" data-id="{{ $employee->id }}"><i class="fa fa-trash"></i></button>
                </div>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="8" class="p-4 text-center">
            <strong style="font-size: 18px; color: gray;">No Employees Found</strong>
        </td>
    </tr>
@endif
