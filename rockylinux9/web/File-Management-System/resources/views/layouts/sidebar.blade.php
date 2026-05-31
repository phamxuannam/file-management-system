<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Management</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Divider -->
    <hr class="sidebar-divider">

    @can('area.view')
        <!-- Nav Item - Area Management -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('areas.index') }}">
                <i class="las la-tags"></i>
                <span>Areas</span>
            </a>
        </li>
    @endcan

    @can('user.view')
        <!-- Nav Item - User Management -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('users.index') }}">
                <i class="las la-tags"></i>
                <span>Users</span>
            </a>
        </li>
    @endcan

    @can('file.view')
        <!-- Nav Item - File Management -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('files.index') }}">
                <i class="las la-tags"></i>
                <span>Files</span>
            </a>
        </li>
    @endcan

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
