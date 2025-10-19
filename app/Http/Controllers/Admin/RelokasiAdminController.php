<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PenjabLayanan;
use App\Models\Relokasi;
use App\Models\Teknisi;
use Illuminate\Http\Request;

class RelokasiAdminController extends Controller
{
    public function index()
    {
        $relokasis = Relokasi::with(['guest', 'teknisi', 'penjab'])->latest()->get();

        return view('admin.relokasi.index', compact('relokasis'));
    }

    public function edit(Relokasi $relokasi)
    {
        $teknisis = Teknisi::all();
        $penjabs = PenjabLayanan::all();
        $statuses = ['pending', 'on progress', 'complete'];

        return view('admin.relokasi.edit', compact('relokasi', 'teknisis', 'penjabs', 'statuses'));
    }

    public function update(Request $request, Relokasi $relokasi)
    {
        $request->validate([
            'teknisi_id' => 'nullable|exists:teknisi,id',
            'status' => 'required|in:pending,on progress,complete',
            'keterangan_admin' => 'nullable|string',
        ]);

        $relokasi->update([
            'teknisi_id' => $request->teknisi_id,
            'status' => $request->status,
            'keterangan_admin' => $request->keterangan_admin,
        ]);

        return redirect()->route('admin.relokasi.index')->with('success', 'Relokasi berhasil diperbarui');
    }

    public function destroy(Relokasi $relokasi)
    {
        // Hapus file surat jika ada
        if ($relokasi->surat_bukti_izin_relokasi) {
            \Storage::delete('public/relokasi/'.$relokasi->surat_bukti_izin_relokasi);
        }

        $relokasi->delete();

        return redirect()->route('admin.relokasi.index')->with('success', 'Relokasi berhasil dihapus');
    }
}
