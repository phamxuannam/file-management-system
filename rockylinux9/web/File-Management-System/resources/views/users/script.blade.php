<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('submit', '#addUser', function(e) {
        e.preventDefault();
        $('.error-text').text('');
        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('users.store') }}",
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('.success_message_create').text(response.message);
                setTimeout(() => {
                    $('.success_message_create').text('');
                }, 2000);
                $('#addUser')[0].reset();
                fetchUser();
            },
            error: function(error) {
                let errors = error.responseJSON.errors;
                $.each(errors, function(key, value) {
                    $('.' + key + '_error').text(value[0]);
                });
            }
        })
    });

    $(document).on('click', '.editBtn', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let name = $(this).data('name');
        let email = $(this).data('email');
        let areaId = $(this).data('area');
        let role = $(this).data('role')


        $('#editUserModal').data('id', id);
        $('#edit_fullname').val(name);
        $('#edit_email').val(email);

        // Check radio area đúng
        $('input[name="area_id"]').prop('checked', false);
        $('#edit_area-' + areaId).prop('checked', true);

        // Check radio role đúng
        $('input[name="role"]').prop('checked', false);
        $('input[name="role"][value="' + role + '"]').prop('checked', true);

        $('#editUserModal').modal('show');
    });
    $(document).on('submit', '#editUser', function(e) {
        e.preventDefault();
        let id = $('#editUserModal').data('id');
        let formData = new FormData(this);
        formData.append('_method', 'PUT');
        $.ajax({
            url: "{{ route('users.update', ':id') }}".replace(':id', id),
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#editUserModal').modal('hide');
                $('.success_message_edit').text(response.message);
                setTimeout(() => {
                    $('.success_message_edit').text('');
                }, 2000);
                fetchUser();
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
        if (!confirm('Ban Chac Chan Muon Xoa Khong?')) return;
        let id = $(this).data('id');
        $.ajax({
            url: "{{ route('users.destroy', ':id') }}".replace(':id', id),
            method: 'DELETE',
            success: function(response) {
                $('.success_message_delete').text(response.message);
                setTimeout(() => {
                    $('.success_message_delete').text('');
                }, 2000);
                fetchUser();
            },
            error: function(error) {
                let errors = error.responseJSON.errors;
                $('.success_message_delete').text(errors.message);
                setTimeout(() => {
                    $('.success_message_delete').text('');
                }, 2000);
            }
        });
    });

    function fetchUser() {
        $.ajax({
            url: "{{ route('users.fetch') }}",
            method: 'GET',
            success: function(response) {
                $('#table-body').html(response);
            }
        });
    }
</script>
