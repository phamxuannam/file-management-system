<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel= "stylesheet"
        href= "https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <title>Document</title>
</head>

<body>
    <div class="container bg-light py-4">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h2 class="d-flex justify-content-between">
                    <span> User Management </span>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addUserModal">Create User</button>
                </h2>
                <h4 class="text-primary my-4 success_message_create"></h4>
                <h4 class="text-success my-4 success_message_edit"> </h4>
                <h4 class="text-danger my-4 success_message_delete"> </h4>

                <div class="table-data">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Fullname</th>
                                <th scope="col">Email</th>
                                <th scope="col">Area</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            @include('users.load-data')
                        </tbody>
                    </table>
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- @include('users.create') --}}
    @include('users.edit')
    @include('users.script')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

</body>

</html>
