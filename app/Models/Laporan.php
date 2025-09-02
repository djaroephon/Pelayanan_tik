<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporan';

    protected $fillable = [
        'guest_id',
        'nama_pelapor',
        'no_hp_pelapor',
        'email_pelapor',
        'instansi',
        'bidang',
        'laporan_permasalahan',
        'kategori_id',
        'ip_jaringan',
        'ip_server',
        'waktu_permasalahan',
        'status',
    ];

    public function guest()
    {
        return $this->belongsTo(Guest::class, 'guest_id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function penyelesaian()
    {
        return $this->hasOne(Penyelesaian::class);
    }

    public function teknisis()
    {
        return $this->belongsToMany(Teknisi::class, 'laporan_teknisi')
            ->withPivot('deskripsi_masalah', 'deskripsi_penyelesaian', 'selesai_pada')
            ->withTimestamps();
    }
}
