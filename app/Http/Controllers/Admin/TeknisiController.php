<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teknisi;
use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;

class TeknisiController extends Controller
{
    public function index()
    {
        $teknisi = Teknisi::withCount(['laporans as jumlah_tugas' => function ($query) {
            $query->where('status', 'complete');
        }])->get();

        return view('admin.teknisi.index', compact('teknisi'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'nama_teknisi' => 'required|string|max:100',
            'no_hp_teknisi' => 'required|string|max:15',
        ]);

        $teknisi = Teknisi::findOrFail($id);
        $teknisi->update([
            'nama_teknisi' => $request->nama_teknisi,
            'no_hp_teknisi' => $request->no_hp_teknisi,
        ]);

        return redirect()->route('teknisi.index')
            ->with('success', 'Teknisi berhasil diperbarui');
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $teknisi = Teknisi::findOrFail($id);
        $teknisi->delete();

        return redirect()->route('teknisi.index')
            ->with('success', 'Teknisi berhasil dihapus');
    }
}
