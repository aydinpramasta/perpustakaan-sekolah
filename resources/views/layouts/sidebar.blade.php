<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-text mx-3">Perpustakaan</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    @if (auth()->user()->role === \App\Models\User::ROLES['Admin'])
        <li class="nav-item {{ request()->routeIs('admin.librarians.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.librarians.index') }}">
                <i class="fas fa-fw fa-book-open"></i>
                <span>Pustakawan</span></a>
        </li>
    @endif

    @if (auth()->user()->role === \App\Models\User::ROLES['Librarian'])
        <li class="nav-item {{ request()->routeIs('admin.members.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.members.index') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>Member</span></a>
        </li>
    @endif

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="mt-auto text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
