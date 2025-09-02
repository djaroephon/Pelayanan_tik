<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PenjabLayanan;
use Illuminate\Http\Request;

class PenjabController extends Controller
{
    public function index()
    {
        $penjabLayanan = PenjabLayanan::latest()->get();

        return view('admin.penjab', compact('penjabLayanan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_penjab_layanan' => 'required|string|max:100',
        ]);

        PenjabLayanan::create(['nama_penjab_layanan' => $request->nama_penjab_layanan]);

        return redirect()->route('penjab.index')->with('success', 'Penjab Layanan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_penjab_layanan' => 'required|string|max:255',
        ]);

        $penjabLayanan = PenjabLayanan::findOrFail($id);
        $penjabLayanan->update(['nama_penjab_layanan' => $request->nama_penjab_layanan]);

        return redirect()->route('penjab.index')->with('success', 'Penjab Layanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $penjabLayanan = PenjabLayanan::findOrFail($id);
        $penjabLayanan->delete();

        return redirect()->route('penjab.index')->with('success', 'Penjab Layanan berhasil dihapus.');
    }
}
