<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Restore;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class MyBookController extends Controller
{
    public function index()
    {
        $currentBorrows = Borrow::query()
            ->with('book')
            ->whereBelongsTo(auth()->user())
            ->whereDoesntHave('restore', function (Builder $query) {
                $query->where('confirmation', true);
            })
            ->latest('id')
            ->paginate(6);

        $recentBorrows = Borrow::query()
            ->with(['book', 'restore'])
            ->whereBelongsTo(auth()->user())
            ->whereHas('restore', function (Builder $query) {
                $query->where('confirmation', true);
            })
            ->latest('id')
            ->limit(6)
            ->get();

        return view('my-books')->with([
            'currentBorrows' => $currentBorrows,
            'recentBorrows' => $recentBorrows,
        ]);
    }

    public function store(Request $request, Book $book)
    {
        $request->validate([
            'duration' => ['required', 'numeric'],
            'amount' => ['required', 'numeric', 'max:' . $book->amount],
        ]);

        Borrow::create([
            'borrowed_at' => now(),
            'duration' => $request->duration,
            'amount' => $request->amount,
            'confirmation' => false,
            'book_id' => $book->id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('my-books.index')->with('success', 'Berhasil mengajukan peminjaman!');
    }

    public function update($id)
    {
        $borrow = Borrow::query()->findOrFail($id);

        if (!$borrow->confirmation || isset($borrow->restore)) {
            return back()->withErrors('Peminjaman ini tidak sesuai!');
        }

        $returnStatus = $borrow->borrowed_at->addDays($borrow->duration) > now() ? Restore::STATUSES['Not confirmed'] : Restore::STATUSES['Past due'];

        Restore::create([
            'returned_at' => now(),
            'status' => $returnStatus,
            'confirmation' => 0,
            'book_id' => $borrow->book->id,
            'user_id' => auth()->id(),
            'borrow_id' => $borrow->id,
        ]);

        return redirect()->route('my-books.index')->with('success', 'Berhasil mengajukan pengembalian!');
    }
}
