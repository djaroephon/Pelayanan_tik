<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PenjabLayanan;
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
        $users = User::with(['teknisi', 'penjabLayanans'])
            ->whereIn('role', ['admin', 'operator', 'teknisi', 'penjab'])
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

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,operator,teknisi,penjab',
        ];

        if ($request->role === 'teknisi') {
            $rules['no_hp_teknisi'] = 'required|string|max:15';
        } elseif ($request->role === 'penjab') {
            $rules['nama_penjab_layanan'] = 'required|array|min:1';
            $rules['nama_penjab_layanan.*'] = 'required|string|max:100';
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
        // Create multiple penjab layanan records if role is penjab
        elseif ($validatedData['role'] === 'penjab') {
            if ($request->has('nama_penjab_layanan')) {
                foreach ($request->nama_penjab_layanan as $namaLayanan) {
                    if (! empty(trim($namaLayanan))) {
                        PenjabLayanan::create([
                            'penjab_id' => $user->id,
                            'nama_penjab_layanan' => trim($namaLayanan),
                        ]);
                    }
                }
            }
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

        $rules = [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|min:8|confirmed',
            'role' => ['required', Rule::in(['admin', 'operator', 'teknisi', 'penjab'])],
        ];

        if ($request->role === 'teknisi') {
            $rules['no_hp_teknisi'] = 'required|string|max:15';
        } elseif ($request->role === 'penjab') {
            $rules['nama_penjab_layanan'] = 'required|array|min:1';
            $rules['nama_penjab_layanan.*'] = 'required|string|max:100';
        }

        $validatedData = $request->validate($rules);

        // Update user data
        $userData = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'role' => $validatedData['role'],
        ];

        if ($validatedData['password'] ?? false) {
            $userData['password'] = Hash::make($validatedData['password']);
        }

        $user->update($userData);

        // Sync teknisi data
        $this->syncTeknisiData($user, $validatedData['role'], $request->no_hp_teknisi ?? null);

        // Sync penjab data (multiple layanan)
        $this->syncPenjabData($user, $validatedData['role'], $request->nama_penjab_layanan ?? []);

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

    /**
     * Sync multiple penjab data based on user role
     */
    protected function syncPenjabData(User $user, string $role, array $namaLayanans): void
    {
        if ($role === 'penjab') {
            $existingLayananIds = [];

            // Update atau create layanan
            foreach ($namaLayanans as $namaLayanan) {
                if (! empty(trim($namaLayanan))) {
                    $layanan = PenjabLayanan::updateOrCreate(
                        [
                            'penjab_id' => $user->id,
                            'nama_penjab_layanan' => trim($namaLayanan),
                        ]
                    );
                    $existingLayananIds[] = $layanan->id;
                }
            }

            // Hapus layanan yang tidak ada dalam list baru
            PenjabLayanan::where('penjab_id', $user->id)
                ->whereNotIn('id', $existingLayananIds)
                ->delete();

        } elseif ($user->penjabLayanans()->exists()) {
            // Hapus semua layanan jika role bukan penjab
            $user->penjabLayanans()->delete();
        }
    }

    /**
     * Get layanan for user (for AJAX in edit modal)
     */
    public function getLayanan($id)
    {
        $user = User::findOrFail($id);
        $layanans = $user->penjabLayanans()->get();

        return response()->json($layanans);
    }
}
