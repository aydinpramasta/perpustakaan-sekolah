<?php

namespace App\Http\Controllers;

use App\Models\Book;

class PreviewController extends Controller
{
    public function __invoke(Book $book)
    {
        return view('preview')->with('book', $book);
    }
}
