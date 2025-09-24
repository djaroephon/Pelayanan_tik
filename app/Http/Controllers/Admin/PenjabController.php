<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PenjabLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Laporan;
use App\Models\Teknisi;

class PenjabController extends Controller
{
      public function index()
    {
        // Ambil SEMUA layanan penjab (multiple)
        $penjabLayanans = PenjabLayanan::where('penjab_id', Auth::id())->get();

        if ($penjabLayanans->isEmpty()) {
            return view('penjab.dashboard', [
                'penjabLayanans' => collect(),
                'laporans' => collect(),
                'teknisis' => collect(),
                'totalLayanan' => 0,
                'laporanAktif' => 0,
                'laporanSelesai' => 0
            ]);
        }

        // Ambil IDs semua layanan
        $layananIds = $penjabLayanans->pluck('id')->toArray();

        // Ambil laporan dari SEMUA layanan
        $laporans = Laporan::whereHas('penyelesaian', function($query) use ($layananIds) {
            $query->whereIn('penjab_layanan_id', $layananIds);
        })->with(['kategori', 'teknisis'])->latest()->take(10)->get();

        // Ambil teknisi dari SEMUA layanan
        $teknisis = Teknisi::whereHas('laporans.penyelesaian', function($query) use ($layananIds) {
            $query->whereIn('penjab_layanan_id', $layananIds);
        })->withCount(['laporans' => function($query) use ($layananIds) {
            $query->whereHas('penyelesaian', function($q) use ($layananIds) {
                $q->whereIn('penjab_layanan_id', $layananIds);
            });
        }])->get();

        // Hitung statistik dari SEMUA layanan
        $totalLayanan = $penjabLayanans->count();

        $laporanAktif = Laporan::whereHas('penyelesaian', function($query) use ($layananIds) {
            $query->whereIn('penjab_layanan_id', $layananIds);
        })->whereIn('status', ['pending', 'on progress'])->count();

        $laporanSelesai = Laporan::whereHas('penyelesaian', function($query) use ($layananIds) {
            $query->whereIn('penjab_layanan_id', $layananIds);
        })->where('status', 'complete')->count();

        return view('penjab.dashboard', compact(
            'penjabLayanans', // plural
            'laporans',
            'teknisis',
            'totalLayanan',
            'laporanAktif',
            'laporanSelesai'
        ));
    }
    public function layanan()
    {
        $penjabLayanan = PenjabLayanan::where('penjab_id', Auth::id())->first();

        if (!$penjabLayanan) {
            return redirect()->route('penjab.dashboard')
                ->with('error', 'Anda belum memiliki layanan yang ditugaskan.');
        }

        $layanan = PenjabLayanan::where('penjab_id', Auth::id())->get();

        return view('penjab.layanan', compact('penjabLayanan', 'layanan'));
    }

    public function laporan()
    {
        $penjabLayanan = PenjabLayanan::where('penjab_id', Auth::id())->first();

        if (!$penjabLayanan) {
            return redirect()->route('penjab.dashboard')
                ->with('error', 'Anda belum memiliki layanan yang ditugaskan.');
        }

        $laporans = Laporan::whereHas('penyelesaian', function($query) use ($penjabLayanan) {
            $query->where('penjab_layanan_id', $penjabLayanan->id);
        })->with(['kategori', 'teknisis', 'penyelesaian'])->latest()->paginate(15);

        return view('penjab.laporan', compact('penjabLayanan', 'laporans'));
    }

    public function laporanDetail($id)
    {
        $penjabLayanan = PenjabLayanan::where('penjab_id', Auth::id())->first();

        if (!$penjabLayanan) {
            return redirect()->route('penjab.dashboard')
                ->with('error', 'Anda belum memiliki layanan yang ditugaskan.');
        }

        $laporan = Laporan::whereHas('penyelesaian', function($query) use ($penjabLayanan) {
            $query->where('penjab_layanan_id', $penjabLayanan->id);
        })->with(['kategori', 'teknisis', 'penyelesaian'])->findOrFail($id);

        return view('penjab.laporan-detail', compact('penjabLayanan', 'laporan'));
    }
}

