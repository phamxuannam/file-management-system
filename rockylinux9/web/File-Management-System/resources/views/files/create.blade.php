<div class="modal fade" id="addFileModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addModalLabel">Upload File</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="addFile" enctype="multipart/form-data">
                @csrf

                <input type="text" style="display:none">
                <input type="password" style="display:none">
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="" class="col-form-label">File:</label>
                        <input type="file" name="file" class="form-control" id="file">
                        <span class="text-danger error-text file_error"></span>
                    </div>

                    <div class="mb-3">
                        <label class="col-form-label">Description:</label>
                        <textarea name="description" class="form-control" id="description"></textarea>
                        <span class="text-danger error-text description_error"></span>
                    </div>

                    <div class="mb-3">
                        <label class="col-form-label">Visibility</label>
                        <div class="d-flex gap-3">
                            <div>
                                <input type="radio" id="visibility_private" name="visibility" value="1">
                                <label for="visibility_private">Private</label>
                            </div>
                            <div>
                                <input type="radio" id="visibility_area" name="visibility" value="2">
                                <label for="visibility_area">Area</label>
                            </div>
                            <div>
                                <input type="radio" id="visibility_public" name="visibility" value="3">
                                <label for="visibility_public">Public</label>
                            </div>
                        </div>
                        <span class="text-danger error-text visibility_error"></span>
                    </div>

                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Create By:</label>
                        <input type="text" value="{{ Auth::user()->fullname }}" class="form-control" disabled>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>

            </form>
        </div>
    </div>
</div>























