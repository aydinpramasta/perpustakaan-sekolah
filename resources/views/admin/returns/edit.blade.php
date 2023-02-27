<x-admin-layout title="Edit Pengembalian">
    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="row" action="{{ route('admin.returns.update', $restore) }}" method="POST">
                @csrf
                @method('PUT')

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

                <div class="col-12 col-md-4 mb-3">
                    <label for="name" class="form-label">Peminjam</label>
                    <input type="text" name="name" class="form-control" id="name"
                        value="{{ $restore->user->name }}" disabled>
                </div>

                <div class="col-12 col-md-4 mb-3">
                    <label for="name" class="form-label">Jumlah Pinjam</label>
                    <input type="text" name="amount" class="form-control" id="amount"
                        value="{{ $restore->borrow->amount . ' hari' }}" disabled>
                </div>

                <div class="col-12 col-md-4 mb-3">
                    <label for="returned_at" class="form-label">Tanggal Pengembalian</label>
                    <input type="text" name="returned_at" class="form-control" id="returned_at"
                        value="{{ $restore->returned_at->locale('id_ID')->isoFormat('LL') }}" disabled>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label for="status" class="form-label">Status</label>
                    <input type="text" name="status" class="form-control" id="status"
                        value="{{ $restore->status }}" disabled>
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label for="fine" class="form-label">Denda</label>
                    <input type="number" name="fine" class="form-control" id="fine"
                        value="{{ $restore->fine ?? '' }}" @disabled(isset($restore->fine) || $restore->returned_at < $restore->borrow->borrowed_at->addDays($restore->borrow->duration))>
                    @error('fine')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex w-100 mt-3 justify-content-end">
                    @switch($restore->status)
                        @case(\App\Models\Restore::STATUSES['Returned'])
                            <span class="text-success my-auto mr-3">Pengembalian ini telah dikonfirmasi.</span>
                        @break

                        @case(\App\Models\Restore::STATUSES['Not confirmed'])
                        @case(\App\Models\Restore::STATUSES['Fine not paid'])
                            <input type="hidden" name="confirmation" value="1">
                            <button type="submit" class="btn btn-success mx-3">Konfirmasi</button>
                        @break

                        @case(\App\Models\Restore::STATUSES['Past due'])
                            <input type="hidden" name="confirmation" value="0">
                            <button type="submit" class="btn btn-danger mx-3">Beri denda</button>
                        @break
                    @endswitch

                    <a href="{{ route('admin.returns.index') }}" class="btn btn-warning mx-3">Kembali</a>

                    @error('confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
