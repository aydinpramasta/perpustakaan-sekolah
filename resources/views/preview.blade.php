<x-app-layout>
    <section class="container min-vh-100">
        <div class="row row-cols-1 row-cols-lg-2 g-5" style="padding-top: 7rem; padding-bottom: 3rem">
            <div class="col">
                <img class="d-block rounded-4 mx-auto" style="width: 70%"
                    src="{{ isset($book->cover) ? asset('storage/' . $book->cover) : asset('storage/placeholder.png') }}"
                    alt="{{ $book->title }}" />
            </div>
            <div class="col">
                <div class="d-flex align-items-center">
                    <h1 class="m-0 fw-bold">{{ $book->title }} ({{ $book->publish_year }})</h1>

                    <div class="ms-3 px-3 py-1 text-white bg-primary rounded-5">
                        {{ $book->category }}
                    </div>
                </div>

                <h2 class="my-3 fs-5">
                    Karya: <span class="fw-bold">{{ $book->writer }}</span>
                </h2>
                
                <h2 class="my-3 fs-5">
                    Jumlah tersedia: <span class="fw-bold">{{ $book->amount }} buku</span>
                </h2>

                <div class="mt-5">
                    {!! $book->synopsis !!}
                </div>

                @if (auth()->check())
                    <form class="my-5" action="{{ route('my-books.store', $book) }}" method="POST">
                        @csrf
                        @method('POST')
                        
                        <div class="row row-cols-1 row-cols-lg-2 mb-3">
                            <div>
                                <label for="duration">Durasi</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="duration" value="{{ old('duration') }}">
                                    <span class="input-group-text">hari</span>
                                </div>
                                @error('duration')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="amount">Jumlah Buku (maks: {{ $book->amount }} buku)</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="amount" value="{{ old('amount') }}">
                                    <span class="input-group-text">buku</span>
                                </div>
                                @error('amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg d-block mx-auto px-5">Pinjam
                            Buku</button>
                    </form>
                @elseif ($book->amount > 0)
                    <button type="button" class="btn btn-outline-secondary btn-lg d-block mx-auto px-5 my-5"
                        disabled>Anda harus login untuk bisa meminjam</button>
                @else
                    <button type="button" class="btn btn-outline-secondary btn-lg d-block mx-auto px-5 my-5"
                        disabled>Buku tidak tersedia</button>
                @endif
            </div>
        </div>
    </section>
</x-app-layout>
