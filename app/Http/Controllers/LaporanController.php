<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LaporanController extends Controller
{
    public function Getform()
    {
        if (! Auth::guard('guest')->check()) {
            return redirect()->route('guest.login');
        }

        $kategori = Kategori::all();
        $guest = Auth::guard('guest')->user();

        return view('pages.form', compact('kategori', 'guest'));
    }

    public function SubmitForm()
    {
        if (! Auth::guard('guest')->check()) {
            return redirect()->route('guest.login');
        }

        $validator = Validator::make(request()->all(), [
            'nama_pelapor' => 'required|string|max:100',
            'no_hp_pelapor' => 'required|string|max:15',
            'email_pelapor' => 'nullable|email|max:100',
            'instansi' => 'required|string|max:100',
            'bidang' => 'required|string|max:100',
            'laporan_permasalahan' => 'required|string',
            'kategori_id' => 'required|exists:kategori,id',
            'ip_jaringan' => 'nullable',
            'ip_server' => 'nullable',
            'waktu_permasalahan' => 'required|date',
        ]);

        $validator->after(function ($validator) {
            $this->validateIps($validator, 'ip_jaringan');
            $this->validateIps($validator, 'ip_server');
        });

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();
        $data['guest_id'] = Auth::guard('guest')->id();

        Laporan::create($data);

        return redirect()->route('guest.home')->with('success', 'Laporan berhasil dikirim!');
    }

    private function validateIps($validator, $field)
    {
        $value = request()->input($field);

        if (empty($value)) {
            return;
        }

        $ips = array_map('trim', explode(',', $value));

        foreach ($ips as $ip) {
            if (str_contains($ip, '/')) {
                $ipParts = explode('/', $ip);
                if (count($ipParts) !== 2 || ! filter_var($ipParts[0], FILTER_VALIDATE_IP) ||
                    ! is_numeric($ipParts[1]) || $ipParts[1] < 0 || $ipParts[1] > 32) {
                    $validator->errors()->add($field, 'Format IP dengan subnet tidak valid (contoh: 192.168.1.1/24)');
                }
            } elseif (! filter_var($ip, FILTER_VALIDATE_IP)) {
                $validator->errors()->add($field, 'Format IP tidak valid');
            }
        }
    }
}
