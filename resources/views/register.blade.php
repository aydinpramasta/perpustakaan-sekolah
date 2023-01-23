<x-guest-layout title="Register">
    <h1 class="fw-bold">Perpustakaan</h1>
    <h3>Register</h3>

    <form action="#"
        class="w-100 d-flex flex-column justify-content-center align-items-center gap-4 my-4 px-4 text-start"
        style="max-width: 500px">
        <div class="w-100">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" id="name" />
        </div>

        <div class="w-100">
            <label for="number_type" class="form-label">Tipe Nomor</label>
            <select name="number_type" class="form-select" id="number_type" aria-label="Pilih tipe nomor">
                <option value="NIS">NIS</option>
                <option value="NIP">NIP</option>
                <option value="NIK">NIK</option>
            </select>
        </div>

        <div class="w-100">
            <label for="number" class="form-label">Nomor</label>
            <input type="number" name="number" class="form-control" id="number" />
        </div>

        <div class="w-100">
            <label for="address" class="form-label">Alamat</label>
            <input type="text" name="address" class="form-control" id="address" />
        </div>

        <div class="w-100">
            <label for="telephone" class="form-label">No. Telepon
                <small class="ms-1 text-muted">contoh: 6281234567890</small></label>

            <div class="input-group">
                <span class="input-group-text">+</span>
                <input type="number" name="telephone" class="form-control" id="telephone" />
            </div>
        </div>

        <div class="w-100">
            <label for="gender" class="form-label">Jenis Kelamin</label>

            <div class="d-flex justify-content-center">
                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="gender" value="Man" />
                        Laki-laki
                    </label>
                </div>

                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="gender" value="Woman" />
                        Perempuan
                    </label>
                </div>
            </div>
        </div>

        <div class="w-100">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" />
        </div>

        <div class="w-100">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" />
        </div>

        <div class="w-100 d-grid mt-4">
            <button type="submit" class="btn btn-primary">
                <span class="fs-5">Register</span>
            </button>
        </div>

        <div class="w-100 d-flex justify-content-end">
            <span>
                Sudah punya akun?
                <a href="{{ route('login') }}">Login!</a>
            </span>
        </div>
    </form>
</x-guest-layout>
