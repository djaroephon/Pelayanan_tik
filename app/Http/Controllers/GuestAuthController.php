<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class GuestAuthController extends Controller
{
    public function home()
    {
        $guest = Auth::guard('guest')->user();
        if (! $guest) {
            return redirect()->route('guest.login');
        }
        $stats = [
            'completed' => $guest->laporan()->where('status', 'complete')->count(),
            'progress' => $guest->laporan()->where('status', 'on progress')->count(),
            'total' => $guest->laporan()->count(),
        ];

        return view('pages.guest.homeguest', compact('guest', 'stats'));
    }

    public function downloadTemplate()
    {
        $filePath = storage_path('app/public/template/Template_Surat_Pernyataan_Pengelola_TIK_SKPA.docx');
        $fileName = 'Template_Surat_Pernyataan_Pengelola_TIK_SKPA.docx';

        if (file_exists($filePath)) {
            return response()->download($filePath, $fileName, [
                'Content-Type' => 'application/pdf',
            ]);
        } else {
            return redirect()->back()->withErrors(['File template tidak ditemukan.']);
        }
    }

    public function laporanSaya()
    {
        $guest = Auth::guard('guest')->user();
        if (! $guest) {
            return redirect()->route('guest.login');
        }

        $laporan = $guest->laporan()->get();

        return view('pages.guest.laporanDetail', compact('guest', 'laporan'));
    }

    public function showLoginForm()
    {
        return view('pages.guest.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nik' => 'required|string',
            'password' => 'required|string',
        ]);

        $guest = Guest::where('nik', $credentials['nik'])->first();

        if ($guest && Hash::check($credentials['password'], $guest->password)) {

            if ($guest->status === 'pending') {
                return back()->withErrors([
                    'nik' => 'Akun Anda belum disetujui oleh admin. Silakan tunggu.',
                ])->onlyInput('nik');
            }

            if ($guest->status === 'rejected') {
                return back()->withErrors([
                    'nik' => 'Akun Anda ditolak oleh admin. Silakan perbaiki data dan daftar kembali.',
                ])->onlyInput('nik');
            }

            Auth::guard('guest')->login($guest);
            $request->session()->regenerate();

            return redirect()->intended(route('guest.home'));
        }

        return back()->withErrors([
            'nik' => 'NIK atau password salah.',
        ])->onlyInput('nik');
    }

    public function showRegistrationForm()
    {
        try {
            $apiResponse = Http::withHeaders([
                'X-API-Key' => env('API_KEY'),
                'Accept' => 'application/json',
            ])->get('http://123.108.103.129:8080/api/skpa');

            $skpas = [];

            if ($apiResponse->successful()) {
                $data = $apiResponse->json();
                if ($data['status'] && isset($data['SKPA'])) {
                    $skpas = $data['SKPA'];
                }
            } else {
                Log::error('Gagal mengambil data SKPA: '.$apiResponse->body());
            }

        } catch (\Exception $e) {
            Log::error('Error mengambil data SKPA: '.$e->getMessage());
            $skpas = [];
        }

        return view('pages.guest.register', compact('skpas'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_pelapor' => 'required|string|max:100',
            'nik' => 'required|string|unique:guest,nik|max:20',
            'nip' => 'required|string|unique:guest,nip|max:20',
            'no_hp' => 'required|string|unique:guest,no_hp|max:20',
            'instansi' => 'required|string|max:100',
            'surat_pernyataan_pengelola' => 'required|file|mimes:pdf|max:2048',
            'ktp' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            $suratName = time().'_'.uniqid().'.'.$request->file('surat_pernyataan_pengelola')->getClientOriginalExtension();
            $suratPath = $request->file('surat_pernyataan_pengelola')->storeAs('documents', $suratName, 'public');

            $ktpName = time().'_'.uniqid().'.'.$request->file('ktp')->getClientOriginalExtension();
            $ktpPath = $request->file('ktp')->storeAs('ktp', $ktpName, 'public');

            Log::info('Files uploaded:', [
                'surat_path' => $suratPath,
                'ktp_path' => $ktpPath,
            ]);

            // Buat guest
            $guest = Guest::create([
                'nama_pelapor' => $request->nama_pelapor,
                'nik' => $request->nik,
                'nip' => $request->nip,
                'no_hp' => $request->no_hp,
                'instansi' => $request->instansi,
                'surat_pernyataan_pengelola' => $suratPath,
                'ktp' => $ktpPath,
                'password' => Hash::make($request->password),
                'status' => 'pending',
            ]);

            Auth::guard('guest')->login($guest);

            return redirect()->route('landing')->with('success', 'Registrasi berhasil! Akun Anda sedang menunggu persetujuan admin.');

        } catch (\Exception $e) {
            Log::error('Registration failed: '.$e->getMessage());
            Log::error('Trace: '.$e->getTraceAsString());

            if (isset($suratPath)) {
                Storage::disk('local')->delete($suratPath);
            }
            if (isset($ktpPath)) {
                Storage::disk('local')->delete($ktpPath);
            }

            return back()->with('error', 'Gagal menyimpan data: '.$e->getMessage())->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('guest')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
