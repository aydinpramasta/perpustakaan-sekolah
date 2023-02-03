<x-admin-layout title="List Pengembalian">
    <div class="card shadow mb-4">
        <div class="card-body">
            @if ($success = session()->get('success'))
                <div class="card border-left-success mb-3">
                    <div class="card-body">{!! $success !!}</div>
                </div>
            @endif

            <x-admin.search url="{{ route('admin.returns.index') }}" placeholder="Cari pengembalian..." />

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Buku</th>
                            <th>Peminjam</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($restores as $restore)
                            <tr>
                                <td>
                                    <img src="{{ isset($restore->book->cover) ? asset('storage/' . $restore->book->cover) : asset('storage/placeholder.png') }}"
                                        alt="{{ $restore->book->title }}" class="rounded" style="width: 100px;">
                                    <span class="ml-3">{{ $restore->book->title }}</span>
                                </td>
                                <td>{{ $restore->user->name }}</td>
                                <td>{{ $restore->returned_at->locale('id_ID')->isoFormat('LL') }}</td>
                                <td>
                                    @switch($restore->status)
                                        @case(\App\Models\Restore::STATUSES['Returned'])
                                            <span class="badge badge-success">{{ $restore->status }}</span>    
                                        @break
                                    
                                        @case(\App\Models\Restore::STATUSES['Not confirmed'])
                                            <span class="badge badge-warning">{{ $restore->status }}</span>
                                        @break

                                        @case(\App\Models\Restore::STATUSES['Past due'])
                                            <span class="badge badge-danger">{{ $restore->status }}</span>
                                        @break

                                        @case(\App\Models\Restore::STATUSES['Fine not paid'])
                                            <span class="badge badge-dark">{{ $restore->status }}</span>
                                        @break
                                    @endswitch
                                </td>
                                <td>
                                    <a href="{{ route('admin.returns.edit', $restore) }}" class="btn btn-link">Edit</a>

                                    <form action="{{ route('admin.returns.destroy', $restore) }}" method="POST"
                                        onsubmit="return confirm('Anda yakin ingin menghapus pengembalian ini?')">
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
                        {{ $restores->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </x-admin-layout>
