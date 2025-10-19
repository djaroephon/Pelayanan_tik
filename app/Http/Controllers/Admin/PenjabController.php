<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\PenjabLayanan;
use App\Models\Teknisi;
use Illuminate\Support\Facades\Auth;

class PenjabController extends Controller
{
    // Helper method untuk mendapatkan penjabLayanans
    private function getPenjabLayanans()
    {
        return PenjabLayanan::where('penjab_id', Auth::id())
            ->withCount('laporans')
            ->get();
    }

    public function index()
    {
        $penjabLayanans = $this->getPenjabLayanans();

        if ($penjabLayanans->isEmpty()) {
            return view('penjab.dashboard', [
                'penjabLayanans' => collect(),
                'laporans' => collect(),
                'teknisis' => collect(),
                'totalLayanan' => 0,
                'laporanAktif' => 0,
                'laporanSelesai' => 0,
            ]);
        }

        $layananIds = $penjabLayanans->pluck('id')->toArray();

        $laporans = Laporan::whereHas('penyelesaian', function ($query) use ($layananIds) {
            $query->whereIn('penjab_layanan_id', $layananIds);
        })->with(['kategori', 'teknisis', 'penyelesaian.penjabLayanan'])->latest()->take(10)->get();

        $teknisis = Teknisi::whereHas('laporans.penyelesaian', function ($query) use ($layananIds) {
            $query->whereIn('penjab_layanan_id', $layananIds);
        })->withCount([
            'laporans as total_laporans_count' => function ($query) use ($layananIds) {
                $query->whereHas('penyelesaian', function ($q) use ($layananIds) {
                    $q->whereIn('penjab_layanan_id', $layananIds);
                });
            },
            'laporans as active_laporans_count' => function ($query) use ($layananIds) {
                $query->whereHas('penyelesaian', function ($q) use ($layananIds) {
                    $q->whereIn('penjab_layanan_id', $layananIds);
                })->where('status', 'on progress');
            },
        ])->get();

        $totalLayanan = $penjabLayanans->count();
        $laporanAktif = Laporan::whereHas('penyelesaian', function ($query) use ($layananIds) {
            $query->whereIn('penjab_layanan_id', $layananIds);
        })->whereIn('status', ['pending', 'on progress'])->count();

        $laporanSelesai = Laporan::whereHas('penyelesaian', function ($query) use ($layananIds) {
            $query->whereIn('penjab_layanan_id', $layananIds);
        })->where('status', 'complete')->count();

        return view('penjab.dashboard', compact(
            'penjabLayanans',
            'laporans',
            'teknisis',
            'totalLayanan',
            'laporanAktif',
            'laporanSelesai'
        ));
    }

    public function layananTeknisis($id)
    {
        $layanan = PenjabLayanan::where('penjab_id', Auth::id())->findOrFail($id);
        $penjabLayanans = $this->getPenjabLayanans();

        $teknisis = Teknisi::whereHas('laporans.penyelesaian', function ($query) use ($id) {
            $query->where('penjab_layanan_id', $id);
        })->with(['laporans' => function ($query) use ($id) {
            $query->whereHas('penyelesaian', function ($q) use ($id) {
                $q->where('penjab_layanan_id', $id);
            });
        }])->get()->map(function ($teknisi) {
            $teknisi->active_laporans_count = $teknisi->laporans->where('status', 'on progress')->count();
            $teknisi->total_laporans_count = $teknisi->laporans->count();
            $teknisi->is_active = $teknisi->active_laporans_count > 0;

            return $teknisi;
        });

        return view('penjab.layanan-teknisis', compact('layanan', 'teknisis', 'penjabLayanans'));
    }

    public function layananLaporans($id)
    {
        $layanan = PenjabLayanan::where('penjab_id', Auth::id())->findOrFail($id);
        $penjabLayanans = $this->getPenjabLayanans();

        $laporans = Laporan::whereHas('penyelesaian', function ($query) use ($id) {
            $query->where('penjab_layanan_id', $id);
        })->with(['kategori', 'teknisis', 'penyelesaian'])->latest()->paginate(15);

        return view('penjab.layanan-laporans', compact('layanan', 'laporans', 'penjabLayanans'));
    }

    public function laporan()
    {
        $penjabLayanans = $this->getPenjabLayanans();

        if ($penjabLayanans->isEmpty()) {
            return redirect()->route('penjab.dashboard')
                ->with('error', 'Anda belum memiliki layanan yang ditugaskan.');
        }

        $layananIds = $penjabLayanans->pluck('id')->toArray();

        $laporans = Laporan::whereHas('penyelesaian', function ($query) use ($layananIds) {
            $query->whereIn('penjab_layanan_id', $layananIds);
        })->with(['kategori', 'teknisis', 'penyelesaian.penjabLayanan'])->latest()->paginate(15);

        return view('penjab.laporan', compact('penjabLayanans', 'laporans'));
    }

    public function laporanDetail($id)
    {
        $penjabLayanans = $this->getPenjabLayanans();

        if ($penjabLayanans->isEmpty()) {
            return redirect()->route('penjab.dashboard')
                ->with('error', 'Anda belum memiliki layanan yang ditugaskan.');
        }

        $layananIds = $penjabLayanans->pluck('id')->toArray();

        $laporan = Laporan::whereHas('penyelesaian', function ($query) use ($layananIds) {
            $query->whereIn('penjab_layanan_id', $layananIds);
        })->with(['kategori', 'teknisis', 'penyelesaian.penjabLayanan'])->findOrFail($id);

        return view('penjab.laporan-detail', compact('laporan', 'penjabLayanans'));
    }

    public function layananDetail($id)
    {
        $layanan = PenjabLayanan::where('penjab_id', Auth::id())->findOrFail($id);
        $penjabLayanans = $this->getPenjabLayanans();

        $totalLaporanLayanan = Laporan::whereHas('penyelesaian', function ($query) use ($id) {
            $query->where('penjab_layanan_id', $id);
        })->count();

        $laporanAktifLayanan = Laporan::whereHas('penyelesaian', function ($query) use ($id) {
            $query->where('penjab_layanan_id', $id);
        })->whereIn('status', ['pending', 'on progress'])->count();

        $laporanSelesaiLayanan = Laporan::whereHas('penyelesaian', function ($query) use ($id) {
            $query->where('penjab_layanan_id', $id);
        })->where('status', 'complete')->count();

        $teknisisLayanan = Teknisi::whereHas('laporans.penyelesaian', function ($query) use ($id) {
            $query->where('penjab_layanan_id', $id);
        })->withCount([
            'laporans as total_laporans_count' => function ($query) use ($id) {
                $query->whereHas('penyelesaian', function ($q) use ($id) {
                    $q->where('penjab_layanan_id', $id);
                });
            },
            'laporans as active_laporans_count' => function ($query) use ($id) {
                $query->whereHas('penyelesaian', function ($q) use ($id) {
                    $q->where('penjab_layanan_id', $id);
                })->where('status', 'on progress');
            },
        ])->get();

        $laporansLayanan = Laporan::whereHas('penyelesaian', function ($query) use ($id) {
            $query->where('penjab_layanan_id', $id);
        })->with(['kategori', 'teknisis', 'penyelesaian.penjabLayanan'])->latest()->take(10)->get();

        return view('penjab.layanan-detail', compact(
            'layanan',
            'penjabLayanans',
            'totalLaporanLayanan',
            'laporanAktifLayanan',
            'laporanSelesaiLayanan',
            'teknisisLayanan',
            'laporansLayanan'
        ));
    }
}
