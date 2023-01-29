<x-admin-layout title="Edit Buku">
    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="row" action="{{ route('admin.books.update', $book) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="col-12 col-md-6 mb-3">
                    <label for="title" class="form-label">Judul</label>
                    <input type="text" name="title" class="form-control" id="title"
                        value="{{ old('title', $book->title) }}">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label for="writer" class="form-label">Penulis</label>
                    <input type="text" name="writer" class="form-control" id="writer"
                        value="{{ old('writer', $book->writer) }}">
                    @error('writer')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-12 mb-3">
                    <label for="synopsis" class="form-label">Sinopsis</label>
                    <textarea name="synopsis" class="form-control" id="synopsis">{{ old('synopsis', $book->synopsis) }}</textarea>
                    @error('synopsis')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-12 mb-3">
                    <label for="category" class="form-label">Kategori</label>
                    <input type="text" name="category" class="form-control" id="category"
                        value="{{ old('category', $book->category) }}">
                    @error('category')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label for="publisher" class="form-label">Penerbit</label>
                    <input type="text" name="publisher" class="form-control" id="publisher"
                        value="{{ old('publisher', $book->publisher) }}">
                    @error('publisher')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label for="publish_year" class="form-label">Tahun Terbit</label>
                    <input type="number" name="publish_year" class="form-control" id="publish_year"
                        value="{{ old('publish_year', $book->publish_year) }}">
                    @error('publish_year')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label for="amount" class="form-label">Jumlah</label>
                    <input type="number" name="amount" class="form-control" id="amount"
                        value="{{ old('amount', $book->amount) }}">
                    @error('amount')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control">
                        @foreach (\App\Models\Book::STATUSES as $status)
                            <option @selected(old('status', $book->status) === $status) value="{{ $status }}">{{ $status }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-12 mb-3">
                    <div class="d-flex justify-content-center">
                        <img id="bookCover" src="{{ isset($book->cover) ? asset('storage/' . $book->cover) : asset('storage/placeholder.png') }}"
                            alt="{{ $book->title }}" class="rounded" style="width: 300px;">
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <label for="cover" class="form-label">Cover <small>(max: 2MB)</small></label>
                    <input type="file" name="cover" class="form-control" id="cover">
                    @error('cover')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex w-100 mt-3 justify-content-end">
                    <a href="{{ route('admin.books.index') }}" class="btn btn-warning mx-3">Kembali</a>
                    <button type="submit" class="btn btn-primary mx-3">Edit</button>
                </div>
            </form>
        </div>
    </div>

    @section('scripts')
        <script src="{{ asset('assets/js/ckeditor.js') }}"></script>
        <script>
            ClassicEditor
                .create(document.getElementById('synopsis'))
                .catch(error => {
                    console.error(error);
                });

            document.getElementById('cover').onchange = (event) => {
                if (event.target.files[0]) {
                    document.getElementById('bookCover').src = URL.createObjectURL(event.target.files[0]);
                }
            };
        </script>
    @endsection
</x-admin-layout>
