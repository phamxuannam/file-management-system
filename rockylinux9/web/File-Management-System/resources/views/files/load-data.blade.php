@foreach ($files as $i => $file)
    <tr>
        <th scope="col">{{ $i + 1 }}</th>
        <th scope="col">{{ $file->file_name }}</th>
        <th scope="col">{{ $file->description }}</th>
        <th scope="col">{{ $file->user->name }}</th>
        <th scope="col">{{ $file->visibility }}</th>
        <th scope="col">{{ \Carbon\Carbon::parse($file->created_at)->format('d M, Y') }}</th>
        <th scope="col">{{ \Carbon\Carbon::parse($file->updated_at)->format('d M, Y') }}</th>
        <th scope="col">
            <a href="#" class="btn btn-sm btn-success editBtn">
                <i class="las la-edit"></i> </a>
            <a href="#" class="btn btn-sm btn-danger deleteBtn" data-id="{{ $file->id }}">
                <i class="las la-times"></i> </a>
        </th>
    </tr>
@endforeach
