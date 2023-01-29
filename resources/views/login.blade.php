<x-guest-layout title="Login">
    <a href="{{ route('home') }}" class="fw-bold fs-1 text-decoration-none text-black">Perpustakaan</a>
    <h3>Login</h3>

    <form action="{{ route('login') }}" method="POST"
        class="w-100 d-flex flex-column justify-content-center align-items-center gap-4 my-4 px-4 text-start"
        style="max-width: 500px">
        @csrf
        @method('POST')

        <div class="w-100">
            <label for="number" class="form-label">Nomor</label>
            <input type="number" name="number" class="form-control" id="number" value="{{ old('number') }}" />
            @error('number')
                <small class="fs-6 text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="w-100">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" />
        </div>

        <div class="w-100 d-flex justify-content-center">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">
                    Ingat saya
                </label>
            </div>
        </div>

        <div class="w-100 d-grid">
            <button type="submit" class="btn btn-primary">
                <span class="fs-5">Login</span>
            </button>
        </div>

        <div class="w-100 d-flex justify-content-end">
            <span>
                Belum punya akun?
                <a href="{{ route('register') }}">Daftar!</a>
            </span>
        </div>
    </form>
</x-guest-layout>
