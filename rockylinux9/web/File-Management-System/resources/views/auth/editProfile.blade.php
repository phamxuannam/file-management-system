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
                        <input type="text" name="fullname" class="form-control" id="edit_fullname">
                        <span class="text-danger error-text fullname_error"></span>
                    </div>

                    <div class="mb-3">
                        <label class="col-form-label">Email:</label>
                        <input type="email" name="email" class="form-control" id="edit_email" disabled>
                        <span class="text-danger error-text email_error"></span>
                    </div>

                    <div class="mb-3">
                        <label for="" class="col-form-label">Current Password:</label>
                        <input type="password" name="current_password" class="form-control" id="current_password">
                        <span class="text-danger error-text current_password_error"></span>
                    </div>

                    <div class="mb-3">
                        <label for="" class="col-form-label">New Password:</label>
                        <input type="password" name="new_password" class="form-control" id="new_password">
                        <span class="text-danger error-text new_password_error"></span>
                    </div>

                    <div class="mb-3">
                        <label for="" class="col-form-label">Confirm Password:</label>
                        <input type="password" name="confirm_password" class="form-control" id="confirm_password">
                        <span class="text-danger error-text confirm_password_error"></span>
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
