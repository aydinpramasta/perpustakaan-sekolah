<x-admin-layout title="List Peminjaman">
    <div class="card shadow mb-4">
        <div class="card-body">
            @if ($success = session()->get('success'))
                <div class="card border-left-success mb-3">
                    <div class="card-body">{!! $success !!}</div>
                </div>
            @endif

            <x-admin.search url="{{ route('admin.borrows.index') }}" placeholder="Cari peminjaman..." />

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Buku</th>
                            <th>Peminjam</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Durasi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($borrows as $borrow)
                            <tr>
                                <td>
                                    <img src="{{ isset($borrow->book->cover) ? asset('storage/' . $borrow->book->cover) : asset('storage/placeholder.png') }}"
                                        alt="{{ $borrow->book->title }}" class="rounded" style="width: 100px;">
                                    <span class="ml-3">{{ $borrow->book->title }}</span>
                                </td>
                                <td>{{ $borrow->user->name }}</td>
                                <td>{{ $borrow->borrowed_at->locale('id_ID')->isoFormat('LL') }}</td>
                                <td>{{ $borrow->duration }} hari</td>
                                <td>
                                    @switch($borrow->confirmation)
                                        @case(true)
                                            <span class="badge badge-success">Terkonfirmasi</span>
                                        @break

                                        @case(false)
                                            <span class="badge badge-warning">Menunggu konfirmasi</span>
                                        @break
                                    @endswitch
                                </td>
                                <td>
                                    <a href="{{ route('admin.borrows.edit', $borrow) }}" class="btn btn-link">Edit</a>

                                    <form action="{{ route('admin.borrows.destroy', $borrow) }}" method="POST"
                                        onsubmit="return confirm('Anda yakin ingin menghapus peminjaman ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-link text-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-5">
                        {{ $borrows->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </x-admin-layout>
