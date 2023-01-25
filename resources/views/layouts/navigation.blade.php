<nav class="navbar navbar-expand-lg fixed-top bg-body-tertiary px-3">
    <div class="container-fluid">
        <a class="navbar-brand fs-4 fw-bold" href="{{ route('home') }}">Perpustakaan</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarItems"
            aria-controls="navbarItems" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarItems">
            <div class="navbar-nav ms-auto">
                @auth
                    <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Anda yakin ingin keluar?')">
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
