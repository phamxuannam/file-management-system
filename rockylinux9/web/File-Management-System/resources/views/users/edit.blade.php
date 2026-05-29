<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editUser" enctype="multipart/form-data" autocomplete="off">
                @csrf

                <input type="text" style="display:none">
                <input type="password" style="display:none">
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="" class="col-form-label">Fullname:</label>
                        <input type="text" name="fullname" value="{{ old('fullname') }}" class="form-control"
                            id="edit_fullname">
                        <span class="text-danger error-text fullname_error"></span>
                    </div>

                    <div class="mb-3">
                        <label class="col-form-label">Email:</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                            id="edit_email" disabled>
                        <span class="text-danger error-text email_error"></span>
                    </div>

                    @can('users.edit')

                        <div class="mb-3">
                            <label for="edit_area" class="col-form-label">Area</label>

                            <div class="d-flex flex-wrap gap-3 mb-3">
                                @if ($areas->isNotEmpty())
                                    @foreach ($areas as $area)
                                        <div class="mt-3">
                                            {{-- {{ $hasRoles->contains($role->id) ? 'checked' : '' }} --}}
                                            <input type="radio" id="edit_area-{{ $area->id }}" class="rounded"
                                                name="area_id" value="{{ $area->id }}">
                                            <label for="area-{{ $area->id }}">{{ $area->name }}</label>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="edit_role" class="col-form-label">Role</label>

                            <div class="d-flex flex-wrap gap-3 mb-3">
                                @if ($roles->isNotEmpty())
                                    @foreach ($roles as $role)
                                        <div class="mt-3">
                                            {{-- {{ $hasRoles->contains($role->id) ? 'checked' : '' }} --}}
                                            <input type="radio" id="edit_role-{{ $role->id }}" class="rounded"
                                                name="role" value="{{ $role->name }}">
                                            <label for="role-{{ $role->id }}">{{ $role->name }}</label>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                        </div>

                    @endcan


                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Create By:</label>
                        <input type="text" value="{{ Auth::user()->fullname }}" class="form-control" disabled>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>

            </form>
        </div>
    </div>
</div>
