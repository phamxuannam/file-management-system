<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                            aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow bg-gradient-primary rounded">
            @auth
                <a class="nav-link dropdown-toggle" href="" id="userDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="lar la-user"></i>
                    <span class="mr-2 d-none d-lg-inline text-white-800 small">
                        {{ Auth::user()->fullname }}<br>
                        @hasanyrole('area_manager|super_admin')
                            ({{ Auth::user()->roles->pluck('name')->implode(', ') }})
                        @endhasanyrole
                    </span>
                </a>

                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item editProfileBtn" href="#" data-id={{ Auth::user()->id }}
                        data-email="{{ Auth::user()->email }}" data-name="{{ Auth::user()->fullname }}">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Edit Profile
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </div>
            @else
                <a class="nav-link" href="{{ route('login') }}">
                    <i class="las la-sign-in-alt"></i>
                    <span class="mr-2 d-none d-lg-inline text-white-800 small">
                        Login
                    </span>
                </a>
            @endauth
        </li>

    </ul>

</nav>
@include('auth.editProfile')
<!-- End of Topbar -->
@push('scripts')
    <script src="{{ asset('js/areas.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.editProfileBtn', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let name = $(this).data('name');
            let email = $(this).data('email');


            $('#editUserModal').data('id', id);
            $('#edit_fullname').val(name);
            $('#edit_email').val(email);

            $('#editUserModal').modal('show');
        });
        $(document).on('submit', '#editUser', function(e) {
            e.preventDefault();
            $('.error-text').text('');
            let id = $('#editUserModal').data('id');
            let formData = new FormData(this);
            formData.append('_method', 'PUT');
            $.ajax({
                url: "{{ route('users.profile') }}",
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
    </script>
@endpush
