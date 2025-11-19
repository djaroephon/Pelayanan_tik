<?php

namespace App\Http\Controllers;

use App\Models\Relokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RelokasiController extends Controller
{
    public function create()
    {
        // Mengambil data guest yang sedang login
        $guest = Auth::guard('guest')->user();

        return view('guest.relokasi.create', compact('guest'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemohon' => 'required|string|max:100',
            'nip' => 'required|string|max:20',
            'instansi' => 'required|string|max:100',
            'jenis_relokasi' => 'required|in:jaringan,lainnya',
            'nama_alat_jaringan' => 'required_if:jenis_relokasi,jaringan|string|max:100',
            'keterangan' => 'nullable|string',
            'ip_address' => 'nullable|ip',
            'instansi_awal' => 'required|string|max:100',
            'koordinat_awal' => 'required|string|max:100',
            'instansi_tujuan' => 'required|string|max:100',
            'koordinat_tujuan' => 'required|string|max:100',
            'surat_bukti_izin_relokasi' => 'required|file|mimes:pdf|max:2048',
        ]);

            $fileName = time().'_'.uniqid().'.'.$request->file('surat_bukti_izin_relokasi')->getClientOriginalExtension();
            $filePath = $request->file('surat_bukti_izin_relokasi')->storeAs('relokasi', $fileName, 'public');

            Log::info('Files uploaded:', [
                'surat_bukti_izin_relokasi' => $filePath,
            ]);


        Relokasi::create([
            'guest_id' => Auth::guard('guest')->id(),
            'nama_pemohon' => $request->nama_pemohon,
            'nip' => $request->nip,
            'instansi' => $request->instansi,
            'jenis_relokasi' => $request->jenis_relokasi,
            'nama_alat_jaringan' => $request->jenis_relokasi == 'jaringan' ? $request->nama_alat_jaringan : null,
            'keterangan' => $request->keterangan,
            'ip_address' => $request->ip_address,
            'instansi_awal' => $request->instansi_awal,
            'koordinat_awal' => $request->koordinat_awal,
            'instansi_tujuan' => $request->instansi_tujuan,
            'koordinat_tujuan' => $request->koordinat_tujuan,
            'surat_bukti_izin_relokasi' => $filePath,
            'status' => 'pending',
        ]);

        return redirect()->route('guest.home')->with('success', 'Pengajuan relokasi berhasil dikirim!');
    }

    public function index()
    {
        $relokasis = Relokasi::where('guest_id', Auth::guard('guest')->id())
            ->latest()
            ->get();

        return view('guest.relokasi.index', compact('relokasis'));
    }
}
