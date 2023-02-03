<x-admin-layout title="List Buku">
    <div class="card shadow mb-4">
        <div class="card-body">
            @if ($success = session()->get('success'))
                <div class="card border-left-success">
                    <div class="card-body">{!! $success !!}</div>
                </div>
            @endif

            <a href="{{ route('admin.books.create') }}" class="btn btn-primary d-block d-sm-inline-block my-3">Tambah</a>

            <x-admin.search url="{{ route('admin.books.index') }}" placeholder="Cari buku..." />

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Cover</th>
                            <th>Kategori</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th>Tahun Terbit</th>
                            <th>Jumlah Tersedia</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($books as $book)
                            <tr>
                                <td>
                                    <img src="{{ isset($book->cover) ? asset('storage/' . $book->cover) : asset('storage/placeholder.png') }}"
                                        alt="{{ $book->title }}" class="rounded" style="width: 100px;">
                                </td>
                                <td>{{ $book->category }}</td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->writer }}</td>
                                <td>{{ $book->publisher }}</td>
                                <td>{{ $book->publish_year }}</td>
                                <td>{{ $book->amount }} buku</td>
                                <td>
                                    @switch($book->status)
                                        @case(\App\Models\Book::STATUSES['Available'])
                                            <span class="badge badge-success">Tersedia</span>
                                        @break

                                        @case(\App\Models\Book::STATUSES['Borrowed'])
                                            <span class="badge badge-warning">Dipinjam</span>
                                        @break
                                    @endswitch
                                </td>
                                <td>
                                    <a href="{{ route('admin.books.edit', $book) }}"
                                        class="btn btn-link">Edit</a>

                                    <form action="{{ route('admin.books.destroy', $book) }}" method="POST"
                                        onsubmit="return confirm('Anda yakin ingin menghapus buku ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-link text-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-5">
                        {{ $books->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </x-admin-layout>
