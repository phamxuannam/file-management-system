<div class="modal fade" id="editAreaModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit Area</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editArea" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">

                    <div class="mb-3">
                        <label for="name" class="col-form-label">Name:</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                            id="edit_name">
                        <span class="text-danger error-text name_error"></span>
                    </div>

                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Update By:</label>
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
