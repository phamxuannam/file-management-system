<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('submit', '#addFile', function(e) {
        e.preventDefault();
        $('.error-text').text('');
        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('files.store') }}",
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('.success_message_create').text(response.message);
                setTimeout(() => {
                    $('.success_message_create').text('');
                }, 2000);
                $('#addFile')[0].reset();
                fetchFile();
            },
            error: function(error) {
                let errors = error.responseJSON.errors;
                $.each(errors, function(key, value) {
                    $('.' + key + '_error').text(value[0]);
                });
            }
        });
    });

    $(document).on('click', '.editBtn', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let description = $(this).data('description');
        let visibility = $(this).data('visibility');
        let original_name = $(this).data('file');

        $('#current_file_name').text(original_name);
        $('input[name="visibility"][value="' + visibility + '"]').prop('checked', true);
        $('#edit_description').val(description);
        $('#editFileModal').data('id', id);

        $('#editFileModal').modal('show');
    });

    $(document).on('submit', '#editFile', function(e) {
        e.preventDefault();
        let id = $('#editFileModal').data('id');
        console.log(id);

        let formData = new FormData(this);
        formData.append('_method', 'PUT');
        $.ajax({
            url: "{{ route('files.update', ':id') }}".replace(':id', id),
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#editFileModal').modal('hide');
                $('.success_message_edit').text(response.message);
                setTimeout(() => {
                    $('.success_message_edit').text('');
                }, 2000);
                fetchFile();
            },
            error: function(error) {
                let errors = error.responseJSON.errors;
                $.each(errors, function(key, value) {
                    $('.' + key + '_error').text(value[0]);
                });
            }
        });
    });

    $(document).on('click', '.deleteBtn', function(e) {
        e.preventDefault();
        if (!confirm('Ban Chac Chan Muon Xoa Khong?')) return;
        let id = $(this).data('id');
        $.ajax({
            url: " {{ route('files.destroy', ':id') }} ".replace(':id', id),
            method: 'DELETE',
            success: function(response) {
                $('.success_message_delete').text(response.message);
                setTimeout(() => {
                    $('.success_message_delete').text('');
                }, 2000);
                fetchFile();
            },
            error: function(error) {

            }
        });
    });

    function fetchFile() {
        $.ajax({
            url: " {{ route('files.fetch') }} ",
            method: 'GET',
            success: function(response) {
                $('#table-body').html(response);
            }
        });
    }
</script>
