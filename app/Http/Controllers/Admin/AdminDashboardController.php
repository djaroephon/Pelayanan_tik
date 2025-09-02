<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalLaporan = Laporan::count();
        $pending = Laporan::where('status', 'pending')->count();
        $complete = Laporan::where('status', 'complete')->count();
        $on_progress = Laporan::where('status', 'on progress')->count();

        $recentReports = Laporan::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalLaporan', 'pending', 'complete', 'on_progress', 'recentReports'));

    }
}
