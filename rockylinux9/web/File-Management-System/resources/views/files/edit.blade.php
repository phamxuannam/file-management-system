<div class="modal fade" id="editFileModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit File</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editFile" enctype="multipart/form-data" autocomplete="off">
                @csrf

                <input type="text" style="display:none">
                <input type="password" style="display:none">
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="" class="col-form-label">File:</label>
                        <input type="file" name="file" class="form-control" id="edit_file">
                        <p id="current_file_name" class="text-muted mt-1"></p>
                        <span class="text-danger error-text file_error"></span>
                    </div>

                    <div class="mb-3">
                        <label class="col-form-label">Description:</label>
                        <textarea name="description" class="form-control" id="edit_description"> </textarea>
                        <span class="text-danger error-text description_error"></span>
                    </div>

                    @if (Auth::user()->hasAnyRole(['area_manager']))
                        <div class="mb-3">
                            <label class="col-form-label">Visibility</label>
                            <div class="d-flex gap-3">
                                <div>
                                    <input type="radio" id="edit_visibility_private" name="visibility" value="1">
                                    <label for="edit_visibility_private">Private</label>
                                </div>
                                <div>
                                    <input type="radio" id="edit_visibility_area" name="visibility" value="2">
                                    <label for="edit_visibility_area">Area</label>
                                </div>
                                <div>
                                    <input type="radio" id="edit_visibility_public" name="visibility" value="3">
                                    <label for="edit_visibility_public">Public</label>
                                </div>
                            </div>
                            <span class="text-danger error-text visibility_error"></span>
                        </div>
                    @endif


                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Edit By:</label>
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
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
