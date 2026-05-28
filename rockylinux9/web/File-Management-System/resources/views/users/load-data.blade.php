@foreach ($users as $i => $user)
    <tr>
        <th scope="col">{{ $i + 1 }}</th>
        <th scope="col">{{ $user->fullname }}</th>
        <th scope="col">{{ $user->email }}</th>
        <th scope="col">{{ $user->roles->pluck('name')->implode(', ') }}</th>
        <th scope="col">{{ $user->area->name ?? null }}</th>
        <th scope="col">{{ \Carbon\Carbon::parse($user->created_at)->format('d M, Y') }}</th>
        <th scope="col">
            @can('user.edit')
                <a href="#" class="btn btn-sm btn-success editBtn" data-id={{ $user->id }}
                    data-email="{{ $user->email }}" data-name="{{ $user->fullname }}" data-area="{{ $user->area_id }}"
                    data-role="{{ $user->getRoleNames()->first() }}">
                    <i class="las la-edit"></i> </a>
            @endcan

            @can('user.delete')
                <a href="#" class="btn btn-sm btn-danger deleteBtn" data-id="{{ $user->id }}">
                    <i class="las la-times"></i> </a>
            @endcan
        </th>
    </tr>
@endforeach
