<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Guest extends Authenticatable
{
    use Notifiable;

    protected $table = 'guest';

    protected $fillable = [
        'nama_pelapor',
        'nik',
        'nip',
        'instansi',
        'no_hp',
        'surat_pernyataan_pengelola',
        'ktp',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'approved');
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'guest_id');
    }
}
