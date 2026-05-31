@foreach ($areas as $i => $area)
    <tr id="row-">
        <td scope="col">{{ $i + 1 }}</td>
        <td scope="col">{{ $area->name }}</td>
        <td scope="col">{{ \Carbon\Carbon::parse($area->created_at)->format('d M, Y') }}</td>
        <td scope="col">{{ \Carbon\Carbon::parse($area->updated_at)->format('d M, Y') }}</td>
        <td scope="col">
            <a href="#" class="btn btn-sm btn-success editBtn" data-id="{{ $area->id }}"
                data-name="{{ $area->name }}">
                <i class="las la-edit"></i>
            </a>
            <a href="#" class="btn btn-sm btn-danger deleteBtn" data-id={{ $area->id }}>
                <i class="las la-times"></i>
            </a>
        </td>
    </tr>
@endforeach
