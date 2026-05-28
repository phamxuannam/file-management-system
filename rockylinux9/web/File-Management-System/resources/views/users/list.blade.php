@extends('layouts.app')

@section('content')
    {{-- <div class="row"> --}}
    {{-- <div class="col-md-2"></div> --}}
    <div class="col-md">
        <h2 class="d-flex justify-content-between">

            @hasrole('area_manager')
                <span> Users Area: {{ Auth::user()->area->name ?? 'N/A' }} </span>
            @endhasrole

            @hasrole('super_admin')
                <span> User Management </span>
            @endhasrole

            @can('user.create')
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">Create
                    User</button>
            @endcan

        </h2>
        <h4 class="text-primary my-4 success_message_create"></h4>
        <h4 class="text-success my-4 success_message_edit"> </h4>
        <h4 class="text-danger my-4 success_message_delete"> </h4>

        <div class="table-responsive">
            <table class="table w-100" border="1">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Fullname</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
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
    {{-- </div> --}}

    @include('users.create')
    @include('users.edit')
    @include('users.script')
@endsection

@push('scripts')
    <script src="{{ asset('js/areas.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
@endpush
