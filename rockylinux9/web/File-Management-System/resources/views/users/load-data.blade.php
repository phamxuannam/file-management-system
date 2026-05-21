@foreach ($users as $i => $user)
    <tbody>
        <tr>
            <th scope="col">{{ $i + 1 }}</th>
            <th scope="col">{{ $user->fullname }}</th>
            <th scope="col">{{ $user->email }}</th>
            <th scope="col">{{ $user->area_id }}</th>
            <th scope="col">{{ $user->created_at }}</th>
            <th scope="col">
                <a href="" class="btn btn-sm btn-success editBtn"> <i class="las la-edit"></i> </a>
                <a href="" class="btn btn-sm btn-danger deleteBtn"> <i class="las la-times"></i> </a>
            </th>
        </tr>
    </tbody>
@endforeach
