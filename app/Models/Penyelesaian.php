<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyelesaian extends Model
{
    protected $table = 'penyelesaian';

    protected $fillable = [
        'laporan_id',
        'penjab_layanan_id',
    ];

    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }

    public function penjabLayanan()
    {
        return $this->belongsTo(PenjabLayanan::class);
    }
}
