<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\WilayahTeknisi;

class GuestAdminController extends Controller
{
    public function index()
    {
        $guests = Guest::orderByRaw("FIELD(status, 'pending', 'approved', 'rejected')")
            ->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.guests.index', compact('guests'));
    }

    public function approve($id)
    {
        $guest = Guest::findOrFail($id);
        $guest->status = 'approved';
        $guest->save();

        WilayahTeknisi::create([
            'nama_wilayah' => $guest->instansi,
            'nama_pic' => $guest->nama_pelapor,
            'ip_address' => null,
            'guest_id' => $guest->id,
        ]);

        return redirect()->route('admin.guests.index')
            ->with('success', 'Akun '.$guest->nama_pelapor.' telah disetujui');
    }

    public function reject($id)
    {
        $guest = Guest::findOrFail($id);
        $guest->status = 'rejected';
        $guest->save();

        return redirect()->route('admin.guests.index')
            ->with('success', 'Akun '.$guest->nama_pelapor.' telah ditolak');
    }

    public function showDocument($filename)
    {
        try {
            // Gunakan Storage facade untuk path yang benar
            $path = Storage::disk('public')->path('documents/'.$filename);

            Log::info('Attempting to access document: '.$path);

            if (! Storage::disk('public')->exists('documents/'.$filename)) {
                Log::error("Document not found: documents/{$filename}");
                abort(404, 'File not found');
            }

            return response()->file($path);

        } catch (\Exception $e) {
            Log::error('Document access error: '.$e->getMessage());
            abort(500, 'Could not access file');
        }
    }

    public function showKtp($filename)
    {
        try {
            $path = Storage::disk('public')->path('ktp/'.$filename);

            Log::info('Attempting to access ktp: '.$path);

            if (! Storage::disk('public')->exists('ktp/'.$filename)) {
                Log::error("KTP not found: ktp/{$filename}");
                abort(404, 'File not found');
            }

            return response()->file($path);

        } catch (\Exception $e) {
            Log::error('KTP access error: '.$e->getMessage());
            abort(500, 'Could not access file');
        }
    }
}
