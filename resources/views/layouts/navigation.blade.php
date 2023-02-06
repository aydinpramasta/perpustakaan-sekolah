<div class="fixed-top">
    @auth
        @if (in_array(auth()->user()->role, [\App\Models\User::ROLES['Admin'], \App\Models\User::ROLES['Librarian']]))
            <div class="navbar px-5 bg-primary-subtle flex justify-content-between">
                <span>Anda adalah <b>{{ auth()->user()->role }}</b></span>

                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Ke Dashboard</a>
            </div>
        @endif
    @endauth

    <nav class="navbar navbar-expand-lg bg-body-tertiary px-3">
        <div class="container-fluid">
            <a class="navbar-brand fs-4 fw-bold" href="{{ route('home') }}">Perpustakaan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarItems"
                aria-controls="navbarItems" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarItems">
                <div class="navbar-nav ms-auto">
                    @auth
                        <a class="nav-link {{ request()->routeIs('my-books.*') ? 'active' : '' }}" href="{{ route("my-books.index") }}">Buku-ku</a>

                        <form action="{{ route('logout') }}" method="POST"
                            onsubmit="return confirm('Anda yakin ingin keluar?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-link nav-link" type="submit">Logout</button>
                        </form>
                    @endauth

                    @guest
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>
</div>
