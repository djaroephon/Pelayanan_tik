<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenjabLayanan extends Model
{
       protected $table = 'penjab_layanan';

    protected $fillable = ['penjab_id', 'nama_penjab_layanan','deskripsi'];

    public function penyelesaians()
    {
        return $this->hasMany(Penyelesaian::class);
    }

    public function penjab()
    {
        return $this->belongsTo(User::class, 'penjab_id');
    }

    public function laporans()
    {
        return $this->hasManyThrough(
            Laporan::class,
            Penyelesaian::class,
            'penjab_layanan_id',
            'id',
            'id',
            'laporan_id'
        );
    }

    public function teknisis()
    {
        return $this->hasManyThrough(
            Teknisi::class,
            Penyelesaian::class,
            'penjab_layanan_id',
            'id',
            'id',
            'laporan_id'
        )->join('laporan_teknisi', 'laporan_teknisi.laporan_id', '=', 'penyelesaian.laporan_id')
         ->whereColumn('laporan_teknisi.teknisi_id', 'teknisi.id')
         ->distinct();
    }

    public function getLaporansCountAttribute()
    {
        return $this->laporans()->count();
    }
}

