<x-admin-layout title="Edit Peminjaman">
    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="row" action="{{ route('admin.borrows.update', $borrow) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="d-flex w-100 mt-3 justify-content-end">
                    @if ($borrow->confirmation)
                        <span class="text-success my-auto mr-3">Peminjaman ini telah terkonfirmasi.</span>
                    @else
                        <input type="hidden" name="confirmation" value="1">
                        <button type="submit" class="btn btn-success mx-3">Konfirmasi</button>
                    @endif

                    <a href="{{ route('admin.borrows.index') }}" class="btn btn-warning mx-3">Kembali</a>

                    @error('confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-12 mb-3">
                    <div class="d-flex justify-content-center">
                        <img id="borrowCover"
                            src="{{ isset($borrow->book->cover) ? asset('storage/' . $borrow->book->cover) : asset('storage/placeholder.png') }}"
                            alt="{{ $borrow->book->title }}" class="rounded" style="width: 300px;">
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <h5 class="text-center">{{ $borrow->book->title }}</h5>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label for="name" class="form-label">Peminjam</label>
                    <input type="text" name="name" class="form-control" id="name"
                        value="{{ $borrow->user->name }}" disabled>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label for="name" class="form-label">Jumlah Pinjam</label>
                    <input type="text" name="amount" class="form-control" id="amount"
                        value="{{ $borrow->amount . ' buku' }}" disabled>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label for="borrowed_at" class="form-label">Tanggal Peminjaman</label>
                    <input type="text" name="borrowed_at" class="form-control" id="borrowed_at"
                        value="{{ $borrow->borrowed_at->locale('id_ID')->isoFormat('LL') }}" disabled>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label for="duration" class="form-label">Durasi</label>
                    <input type="text" name="duration" class="form-control" id="duration"
                        value="{{ $borrow->duration . ' hari' }}" disabled>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
