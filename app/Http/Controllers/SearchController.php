<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $books = Book::query()
            ->where('title', 'LIKE', "%{$request->search}%")
            ->orWhere('publisher', 'LIKE', "%{$request->search}%")
            ->orWhere('writer', 'LIKE', "%{$request->search}%")
            ->orWhere('publish_year', 'LIKE', "%{$request->search}%")
            ->orWhere('category', 'LIKE', "%{$request->search}%")
            ->orWhere('status', 'LIKE', "%{$request->search}%")
            ->latest('id')
            ->paginate(12);

        return view('search')->with([
            'books' => $books,
        ]);
    }
}
