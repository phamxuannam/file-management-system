<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //create
    $(document).on('click', '#createArea', function(e) {
        e.preventDefault();
        let formData = new FormData($('#addArea')[0]);
        $('.error-text').text('');

        $.ajax({
            url: "{{ route('areas.store') }}",
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#addAreaModal').modal('hide');
                $('.success_message_create').text(response.message);
                setTimeout(() => {
                    $('.success_message_create').text('');
                }, 2000);
                $('#addArea')[0].reset();
                fetchArea();
            },
            error: function(err) {
                let errors = err.responseJSON.errors;
                $.each(errors, function(key, value) {
                    $('.' + key + '_error').text(value[0]);
                });
            }
        });
    });

    $(document).on('click', '#createAndCreateAnother', function(e) {
        e.preventDefault();
        let formData = new FormData($('#addArea')[0]);
        $('.error-text').text('');

        $.ajax({
            url: "{{ route('areas.store') }}",
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                alert(response.message);
                $('#addArea')[0].reset();
                fetchArea();
            },
            error: function(err) {
                let errors = err.responseJSON.errors;
                $.each(errors, function(key, value) {
                    $('.' + key + '_error').text(value[0]);
                });
            }
        });
    });

    //update
    $(document).on('click', '.editBtn', function(e) {
        e.preventDefault();

        let id = $(this).data('id');
        $('#editAreaModal').data('id', id);

        $('#edit_name').val($(this).data('name'));
        $('#editAreaModal').modal('show');
    });
    $(document).on('submit', '#editArea', function(e) {
        e.preventDefault();

        let id = $('#editAreaModal').data('id');
        console.log(id);
        $('.error-text').text('');

        let formData = new FormData(this);
        formData.append('_method', 'PUT');

        $.ajax({
            url: "{{ route('areas.update', ':id') }}".replace(':id', id),
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#editAreaModal').modal('hide');
                $('.success_message_edit').text(response.message);
                setTimeout(() => {
                    $('.success_message_edit').text('');
                }, 2000);
                fetchArea();
            },
            error: function(error) {
                let errors = error.responseJSON.errors;
                $.each(errors, function(key, values) {
                    $('.' + key + '_error').text(values[0]);
                });
            }
        });
    });

    //delete
    $(document).on('click', '.deleteBtn', function(e) {
        e.preventDefault();
        if (!confirm('Ban Chac Chan Muon Xoa Khong?')) return;
        let id = $(this).data('id');
        $.ajax({
            url: "{{ route('areas.destroy', ':id') }}".replace(':id', id),
            method: 'DELETE',
            success: function(response) {
                $('.success_message_delete').text(response.message);
                setTimeout(() => {
                    $('.success_message_delete').text('');
                }, 2000);
                fetchArea();
            },
            error: function(error) {

            }
        });
    });

    function fetchArea() {
        $.ajax({
            url: "{{ route('areas.fetch') }}",
            method: 'GET',
            success: function(response) {
                $('#table-body').html(response);
            }
        });
    }
</script>
