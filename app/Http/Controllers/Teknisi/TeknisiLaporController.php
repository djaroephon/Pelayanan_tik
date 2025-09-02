<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeknisiLaporController extends Controller
{
    public function index()
    {
        $teknisi = Auth::user()->teknisi;

        if (! $teknisi) {
            $laporans = collect();
            $pending = 0;
            $completeThisMonth = 0;
            $on_progress = 0;
            $totalReports = 0;

        } else {
            $laporans = $teknisi->laporans()
                ->with('kategori')
                ->get();

            $pending = $teknisi->laporans()->where('status', 'pending')->count();
            $on_progress = $teknisi->laporans()->where('status', 'on progress')->count();
            $totalReports = $teknisi->laporans()->count();

            $completeThisMonth = $teknisi->laporans()
                ->where('status', 'complete')
                ->whereMonth('laporan.created_at', Carbon::now()->month)
                ->count();
        }

        return view('teknisi.index', compact('laporans', 'pending', 'completeThisMonth', 'on_progress', 'totalReports'));
    }

    public function edit(Laporan $laporan)
    {
        $teknisi = Auth::user()->teknisi;

        if (! $teknisi || ! $teknisi->laporans()->where('laporan_id', $laporan->id)->exists()) {
            abort(403, 'Anda tidak diizinkan mengakses laporan ini.');
        }

        return view('teknisi.edit', compact('laporan'));
    }

    public function update(Request $request, Laporan $laporan)
    {
        $request->validate([
            'deskripsi_masalah' => 'required|string|max:10000',
            'deskripsi_penyelesaian' => 'required|string|max:1000',
        ]);

        $teknisi = Auth::user()->teknisi;

        if (! $teknisi || ! $teknisi->laporans()->where('laporan_id', $laporan->id)->exists()) {
            abort(403, 'Anda tidak diizinkan mengakses laporan ini.');
        }

        $laporan->teknisis()->updateExistingPivot($teknisi->id, [
            'deskripsi_masalah' => $request->deskripsi_masalah,
            'deskripsi_penyelesaian' => $request->deskripsi_penyelesaian,
            'selesai_pada' => now(),
        ]);

        return redirect()->route('teknisi.index')->with('success', 'Penyelesaian berhasil disimpan');
    }


    public function Layanan()
    {
        $teknisi = Auth::user()->teknisi;

        if (! $teknisi) {
            $laporans = collect();
        } else {
            $laporans = $teknisi->laporans()
                ->with('kategori')
                ->get();
        }

        return view('teknisi.layanan', compact('laporans'));
    }
}
