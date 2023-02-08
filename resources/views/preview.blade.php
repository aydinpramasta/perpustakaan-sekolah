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

                <div class="mt-5">
                    {!! $book->synopsis !!}
                </div>

                @if ($book->amount > 0)
                    <form action="{{ route('my-books.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <input type="hidden" name="duration" value="3">
                        <input type="hidden" name="amount" value="1">
                        <button type="submit" class="btn btn-primary btn-lg d-block mx-auto px-5 my-5">Pinjam
                            Buku</button>
                    </form>
                @else
                    <button type="button" class="btn btn-outline-secondary btn-lg d-block mx-auto px-5 my-5"
                        disabled>Buku tidak tersedia</button>
                @endif
            </div>
        </div>
    </section>
</x-app-layout>
