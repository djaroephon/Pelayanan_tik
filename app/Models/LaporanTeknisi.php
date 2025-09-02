<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanTeknisi extends Model
{
    protected $table = 'laporan_teknisi';

    protected $fillable = [
        'laporan_id',
        'teknisi_id',
        'deskripsi_masalah',
        'deskripsi_penyelesaian',
        'selesai_pada',
    ];

    public $timestamps = true;
}
