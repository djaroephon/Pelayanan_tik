<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Laporan;
use App\Models\PenjabLayanan;
use App\Models\Teknisi;
use Illuminate\Http\Request;

class LaporanAdminController extends Controller
{
    public function Getform()
    {
        $kategori = Kategori::all();

        return view('pages.form', compact('kategori'));
    }

    public function SubmitForm(Request $request)
    {
        $validator = $request->validate([
            'nama_pelapor' => 'required|string|max:100',
            'no_hp_pelapor' => 'required|string|max:15',
            'email_pelapor' => 'nullable|email|max:100',
            'instansi' => 'required|string|max:100',
            'bidang' => 'required|string|max:100',
            'laporan_permasalahan' => 'required|string',
            'kategori_id' => 'required|exists:kategori,id',
            'ip_jaringan' => 'nullable|ip',
            'ip_server' => 'nullable|ip',
            'waktu_permasalahan' => 'required|date',
        ]);

        $validator['status'] = 'Baru';

        Laporan::create($validator);

        return redirect()->route('landing')->with('success', 'Laporan berhasil dikirim!');
    }

    public function index()
    {
        $laporans = Laporan::with(['kategori', 'teknisis', 'penyelesaian.penjabLayanan'])
            ->latest()
            ->get();

        return view('admin.laporan.index', compact('laporans'));
    }

    public function edit(Laporan $laporan)
    {
        $teknisis = Teknisi::all();
        $penjabs = PenjabLayanan::all();
        $statuses = ['pending', 'on progress', 'complete'];

        return view('admin.laporan.edit', compact('laporan', 'teknisis', 'penjabs', 'statuses'));
    }

    public function update(Request $request, Laporan $laporan)
    {
        $request->validate([
            'teknisi_ids' => 'nullable|array',
            'teknisi_ids.*' => 'exists:teknisi,id',
            'penjab_id' => 'required|exists:penjab_layanan,id',
            'status' => 'required|in:pending,on progress,complete',
        ]);

        // Assign teknisi
        $laporan->teknisis()->sync($request->teknisi_ids ?? []);

        // Assign penjab layanan
        $laporan->penyelesaian()->updateOrCreate(
            ['laporan_id' => $laporan->id],
            ['penjab_layanan_id' => $request->penjab_id]
        );

        $laporan->update(['status' => $request->status]);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil diperbarui');
    }
}
