<x-admin-layout title="Edit Pengembalian">
    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="row" action="{{ route('admin.returns.update', $restore) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="d-flex w-100 mt-3 justify-content-end">
                    <a href="{{ route('admin.returns.index') }}" class="btn btn-warning mx-3">Kembali</a>

                    @switch($restore->confirmation)
                        @case(true)
                            <input type="hidden" name="confirmation" value="0">
                            <button type="submit" class="btn btn-danger mx-3">Batal Konfirmasi</button>
                        @break

                        @case(false)
                            <input type="hidden" name="confirmation" value="1">
                            <button type="submit" class="btn btn-success mx-3">Konfirmasi</button>
                        @break
                    @endswitch

                    @error('confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-12 mb-3">
                    <div class="d-flex justify-content-center">
                        <img id="restoreCover"
                            src="{{ isset($restore->book->cover) ? asset('storage/' . $restore->book->cover) : asset('storage/placeholder.png') }}"
                            alt="{{ $restore->book->title }}" class="rounded" style="width: 300px;">
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <h5 class="text-center">{{ $restore->book->title }}</h5>
                </div>

                <div class="col-12 mb-3">
                    <label for="name" class="form-label">Peminjam</label>
                    <input type="text" name="name" class="form-control" id="name"
                        value="{{ $restore->user->name }}" disabled>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label for="restoreed_at" class="form-label">Tanggal Pengembalian</label>
                    <input type="text" name="restoreed_at" class="form-control" id="restoreed_at"
                        value="{{ $restore->returned_at->locale('id_ID')->isoFormat('LL') }}" disabled>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label for="duration" class="form-label">Denda</label>
                    <input type="text" name="duration" class="form-control" id="duration"
                        value="{{ $restore->fine }}" disabled>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
