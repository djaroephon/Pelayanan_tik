<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teknisi extends Model
{
    protected $table = 'teknisi';

    protected $fillable = [
        'nama_teknisi',
        'no_hp_teknisi',
        'user_id',
    ];

    public function laporans()
    {
        return $this->belongsToMany(Laporan::class, 'laporan_teknisi')
            ->withPivot('deskripsi_masalah', 'deskripsi_penyelesaian', 'selesai_pada')
            ->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    // Count active laporans (on progress)
    public function getActiveLaporansCountAttribute()
    {
        return $this->laporans()->where('status', 'on progress')->count();
    }

    // Check if teknisi is active
    public function getIsActiveAttribute()
    {
        return $this->active_laporans_count > 0;
    }
}
