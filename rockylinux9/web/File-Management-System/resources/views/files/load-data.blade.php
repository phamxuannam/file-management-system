@foreach ($files as $i => $file)
    <tr>
        <th scope="col">{{ $i + 1 }}</th>
        <th scope="col">{{ $file->original_name }}</th>
        <th scope="col">{{ $file->description }}</th>
        <th scope="col">{{ $file->user->fullname }}</th>
        <th scope="col">{{ $file->visibility_label }}</th>
        <th scope="col">{{ \Carbon\Carbon::parse($file->created_at)->format('d M, Y') }}</th>
        <th scope="col">{{ \Carbon\Carbon::parse($file->updated_at)->format('d M, Y') }}</th>
        <th scope="col">
            <a href="#" class="btn btn-sm btn-success editBtn" data-id="{{ $file->id }}"
                data-file="{{ $file->original_name }}" data-description="{{ $file->description }}"
                data-visibility="{{ $file->visibility }}">
                <i class="las la-edit"></i> </a>
            <a href="#" class="btn btn-sm btn-danger deleteBtn" data-id="{{ $file->id }}">
                <i class="las la-times"></i> </a>
        </th>
    </tr>
@endforeach
