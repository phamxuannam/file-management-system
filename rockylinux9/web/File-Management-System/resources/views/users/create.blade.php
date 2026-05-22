<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addModalLabel">Create User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addUser" enctype="multipart/form-data" autocomplete="off">
                @csrf

                <input type="text" style="display:none">
                <input type="password" style="display:none">
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="" class="col-form-label">Fullname:</label>
                        <input type="text" name="fullname" class="form-control" id="fullname">
                        <span class="text-danger error-text fullname_error"></span>
                    </div>

                    <div class="mb-3">
                        <label class="col-form-label">Email:</label>
                        <input type="email" name="email" class="form-control" id="email">
                        <span class="text-danger error-text email_error"></span>
                    </div>

                    <div class="mb-3">
                        <label for="" class="col-form-label">Password:</label>
                        <input type="password" name="password" class="form-control" id="password">
                        <span class="text-danger error-text password_error"></span>
                    </div>

                    <div class="mb-3">
                        <label for="" class="col-form-label">Confirm Password:</label>
                        <input type="password" name="confirm_password" class="form-control" id="confirm_password">
                        <span class="text-danger error-text confirm_password_error"></span>
                    </div>

                    <div class="mb-3">
                        <label for="area" class="col-form-label">Area</label>

                        <div class="d-flex flex-wrap gap-3 mb-3">
                            @if ($areas->isNotEmpty())
                                @foreach ($areas as $area)
                                    <div class="mt-3">
                                        {{-- {{ $hasRoles->contains($role->id) ? 'checked' : '' }} --}}
                                        <input type="radio" id="area-{{ $area->id }}" class="rounded"
                                            name="area_id" value="{{ $area->id }}">
                                        <label for="area-{{ $area->id }}">{{ $area->name }}</label>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="col-form-label">Role</label>

                        <div class="d-flex flex-wrap gap-3 mb-3">
                            @if ($roles->isNotEmpty())
                                @foreach ($roles as $role)
                                    <div class="mt-3">
                                        {{-- {{ $hasRoles->contains($role->id) ? 'checked' : '' }} --}}
                                        <input type="radio" id="role-{{ $role->id }}" class="rounded"
                                            name="role" value="{{ $role->name }}">
                                        <label for="role-{{ $role->id }}">{{ $role->name }}</label>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Create By:</label>
                        <input type="text" value="{{ Auth::user()->fullname }}" class="form-control" disabled>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>

            </form>
        </div>
    </div>
</div>
