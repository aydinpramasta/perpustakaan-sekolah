<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrow;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BorrowController extends Controller
{
    public function index(Request $request)
    {
        $borrows = Borrow::with(['book', 'user']);

        $borrows->when($request->search, function (Builder $query) use ($request) {
            $query->where(function (Builder $q) use ($request) {
                $q->whereHas('book', function (Builder $query) use ($request) {
                    $query->where('title', 'LIKE', "%{$request->search}%");
                })
                    ->orWhereHas('user', function (Builder $query) use ($request) {
                        $query->where('name', 'LIKE', "%{$request->search}%");
                    });
            });
        });

        $borrows = $borrows->latest('id')->paginate(10);

        return view('admin.borrows.index')->with([
            'borrows' => $borrows,
        ]);
    }

    public function edit(Borrow $borrow)
    {
        return view('admin.borrows.edit')->with([
            'borrow' => $borrow,
        ]);
    }

    public function update(Request $request, Borrow $borrow)
    {
        $data = $request->validate([
            'confirmation' => ['required', Rule::in([1])],
        ]);

        // jika peminjaman belum terkonfirmasi kemudian saat ini dikonfirmasi
        if (!$borrow->confirmation) {
            $borrow->book()->decrement('amount', $borrow->amount);
        }

        $borrow->update($data);

        return redirect()
            ->route('admin.borrows.index')
            ->with('success', 'Berhasil mengubah status konfirmasi peminjaman.');
    }

    public function destroy(Borrow $borrow)
    {
        $borrow->delete();

        return redirect()
            ->route('admin.borrows.index')
            ->with('success', 'Berhasil menghapus peminjaman.');
    }
}
