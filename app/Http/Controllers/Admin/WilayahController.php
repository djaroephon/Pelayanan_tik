<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\Teknisi;
use App\Models\WilayahTeknisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WilayahController extends Controller
{
    public function index()
    {
        $wilayahs = WilayahTeknisi::with(['teknisis', 'guest'])->get();

        return view('admin.wilayah.index', compact('wilayahs'));
    }

    public function create()
    {
        $teknisis = Teknisi::all();
        $guests = Guest::where('status', 'approved')->get();

        return view('admin.wilayah.create', compact('teknisis', 'guests'));
    }

    public function edit($id)
    {
        $wilayah = WilayahTeknisi::with('teknisis')->findOrFail($id);
        $teknisis = Teknisi::all();

        return view('admin.wilayah.edit', compact('wilayah', 'teknisis'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'operator') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'ip_address' => 'required|string|max:255',
            'teknisi_ids' => 'array',
            'teknisi_ids.*' => 'exists:teknisi,id',

        ]);

        $wilayah = WilayahTeknisi::findOrFail($id);
        $wilayah->update([
            'ip_address' => $request->ip_address,
        ]);

        $wilayah->teknisis()->sync($request->teknisi_ids ?? []);

        return redirect()->route('wilayah.index')
            ->with('success', 'Wilayah berhasil diperbarui');
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'operator') {
            abort(403, 'Unauthorized action.');
        }

        $wilayah = WilayahTeknisi::findOrFail($id);
        $wilayah->teknisis()->detach();
        $wilayah->delete();

        return redirect()->route('wilayah.index')
            ->with('success', 'Wilayah berhasil dihapus');
    }
}
