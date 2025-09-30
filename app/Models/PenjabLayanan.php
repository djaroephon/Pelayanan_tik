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
            'penjab_layanan_id', // Foreign key on penyelesaian table
            'id', // Foreign key on laporan table
            'id', // Local key on penjab_layanan table
            'laporan_id' // Local key on penyelesaian table
        );
    }

    // Relasi dengan teknisi melalui penyelesaian dan laporan_teknisi
    public function teknisis()
    {
        return $this->hasManyThrough(
            Teknisi::class,
            Penyelesaian::class,
            'penjab_layanan_id', // Foreign key on penyelesaian table
            'id', // Foreign key on teknisi table
            'id', // Local key on penjab_layanan table
            'laporan_id' // Local key on penyelesaian table
        )->join('laporan_teknisi', 'laporan_teknisi.laporan_id', '=', 'penyelesaian.laporan_id')
         ->whereColumn('laporan_teknisi.teknisi_id', 'teknisi.id')
         ->distinct();
    }

    // Count laporans
    public function getLaporansCountAttribute()
    {
        return $this->laporans()->count();
    }
}
