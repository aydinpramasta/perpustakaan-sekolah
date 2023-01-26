<?php

namespace App\Http\Controllers;

use App\Models\Book;

class HomeController extends Controller
{
    public function __invoke()
    {
        $popularBooks = Book::query()
            ->withCount('borrows')
            ->orderBy('borrows_count', 'desc')
            ->limit(6)
            ->get();

        $newestBooks = Book::query()
            ->select('id', 'title', 'cover', 'created_at')
            ->latest('id')
            ->limit(6)
            ->get();

        return view('home')->with([
            'popularBooks' => $popularBooks,
            'newestBooks' => $newestBooks,
        ]);
    }
}
