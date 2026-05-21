@foreach ($areas as $i => $area)
    <tr id="row-">
        <th scope="col">{{ $i + 1 }}</th>
        <th scope="col">{{ $area->name }}</th>
        <th scope="col">{{ $area->created_at }}</th>
        <th scope="col">{{ $area->updated_at }}</th>
        <th scope="col">
            <a href="#" class="btn btn-sm btn-success editBtn" data-id={{ $area->id }}
                data-name={{ $area->name }}>
                <i class="las la-edit"></i>
            </a>
            <a href="#" class="btn btn-sm btn-danger deleteBtn" data-id={{ $area->id }}>
                <i class="las la-times"></i>
            </a>
        </th>
    </tr>
@endforeach
