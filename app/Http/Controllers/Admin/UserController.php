<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teknisi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('teknisi')
            ->whereIn('role', ['admin', 'operator', 'teknisi'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        // Define base validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,operator,teknisi',
        ];

        // Add conditional validation for teknisi fields
        if ($request->role === 'teknisi') {
            $rules['no_hp_teknisi'] = 'required|string|max:15';
        }

        $validatedData = $request->validate($rules);

        // Create user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['role'],
        ]);

        // Create teknisi record if role is teknisi
        if ($validatedData['role'] === 'teknisi') {
            Teknisi::create([
                'nama_teknisi' => $validatedData['name'],
                'no_hp_teknisi' => $request->no_hp_teknisi,
                'user_id' => $user->id,
            ]);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        // Define base validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|min:8|confirmed',
            'role' => ['required', Rule::in(['admin', 'operator', 'teknisi'])],
        ];

        // Add conditional validation for teknisi fields
        if ($request->role === 'teknisi') {
            $rules['no_hp_teknisi'] = 'required|string|max:15';
        }

        $validatedData = $request->validate($rules);

        // Prepare user data
        $userData = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'role' => $validatedData['role'],
        ];

        // Update password if provided
        if ($validatedData['password'] ?? false) {
            $userData['password'] = Hash::make($validatedData['password']);
        }

        // Update user
        $user->update($userData);

        // Handle teknisi data
        $this->syncTeknisiData($user, $validatedData['role'], $request->no_hp_teknisi ?? null);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus');
    }

    /**
     * Sync teknisi data based on user role
     */
    protected function syncTeknisiData(User $user, string $role, ?string $noHpTeknisi): void
    {
        if ($role === 'teknisi') {
            if ($user->teknisi) {
                $user->teknisi->update([
                    'nama_teknisi' => $user->name,
                    'no_hp_teknisi' => $noHpTeknisi,
                ]);
            } else {
                Teknisi::create([
                    'nama_teknisi' => $user->name,
                    'no_hp_teknisi' => $noHpTeknisi,
                    'user_id' => $user->id,
                ]);
            }
        } elseif ($user->teknisi) {
            $user->teknisi->delete();
        }
    }
}
