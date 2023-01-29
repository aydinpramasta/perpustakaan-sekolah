<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $members = User::query()
            ->where('role', User::ROLES['Member']);

        $members->when($request->search, function (Builder $query) use ($request) {
            $query->where(function (Builder $q) use ($request) {
                $q->where('name', 'LIKE', "%{$request->search}%")
                    ->orWhere('number_type', 'LIKE', "%{$request->search}%")
                    ->orWhere('number', 'LIKE', "%{$request->search}%")
                    ->orWhere('telephone', 'LIKE', "%{$request->search}%");
            });
        });

        $members = $members->latest()->paginate(25);

        return view('admin.members.index')->with([
            'members' => $members,
        ]);
    }

    public function create()
    {
        return view('admin.members.create');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'number_type' => ['required', Rule::in(User::NUMBER_TYPES)],
            'number' => ['required', 'numeric', 'unique:' . User::class],
            'address' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'numeric'],
            'gender' => ['required', Rule::in(User::GENDERS)],
            'password' => ['required', 'string', 'confirmed', 'max:255'],
        ]);

        $credentials['role'] = User::ROLES['Member'];

        $password = $credentials['password'];
        $credentials['password'] = Hash::make($password);

        User::create($credentials);

        return redirect()
            ->route('admin.members.index')
            ->with(
                'success',
                "Berhasil menambah member.
                <br />
                Nomor: {$credentials['number']}
                <br />
                Password: {$password}"
            );
    }

    public function edit($id)
    {
        $member = User::query()
            ->where('role', User::ROLES['Member'])
            ->findOrFail($id);

        return view('admin.members.edit')->with('member', $member);
    }

    public function update(Request $request, $id)
    {
        $member = User::query()
            ->where('role', User::ROLES['Member'])
            ->findOrFail($id);

        $credentials = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'number_type' => ['required', Rule::in(User::NUMBER_TYPES)],
            'number' => ['required', 'numeric', Rule::unique(User::class)->ignore($member->id)],
            'address' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'numeric'],
            'gender' => ['required', Rule::in(User::GENDERS)],
        ]);

        $credentials['role'] = User::ROLES['Member'];

        $successMessage = "Berhasil mengedit member. <br /> Nomor: {$credentials['number']}";

        if (isset($request->password)) {
            $newPassword = $request->validate([
                'password' => ['required', 'string', 'confirmed', 'max:255'],
            ])['password'];

            $credentials['password'] = Hash::make($newPassword);

            $successMessage .= " <br /> Password Baru: {$newPassword}";
        }

        $member->update($credentials);

        return redirect()
            ->route('admin.members.index')
            ->with('success', $successMessage);
    }

    public function destroy($id)
    {
        $member = User::query()
            ->where('role', User::ROLES['Member'])
            ->findOrFail($id);

        $member->delete();

        return redirect()
            ->route('admin.members.index')
            ->with('success', 'Berhasil menghapus member.');
    }
}
