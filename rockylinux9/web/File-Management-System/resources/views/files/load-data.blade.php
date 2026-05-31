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
            @auth
                @if (Auth::user()->hasRole('super_admin') ||
                        Auth::id() == $file->user_id ||
                        (Auth::user()->hasRole('area_manager') && Auth::user()->area_id == $file->user->area_id))
                    <a href="#" class="btn btn-sm btn-success editBtn" data-id="{{ $file->id }}"
                        data-file="{{ $file->original_name }}" data-description="{{ $file->description }}"
                        data-visibility="{{ $file->visibility }}">
                        <i class="las la-edit"></i> </a>

                    <a href="#" class="btn btn-sm btn-danger deleteBtn" data-id="{{ $file->id }}">
                        <i class="las la-times"></i> </a>
                @endif
            @endauth

            <a href="{{ route('files.download', $file->id) }}" class="btn btn-sm btn-primary downloadBtn">
                <i class="las la-download"></i> </a>
        </th>
    </tr>
@endforeach
