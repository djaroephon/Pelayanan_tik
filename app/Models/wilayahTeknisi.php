<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class wilayahTeknisi extends Model
{
    protected $table = 'wilayah_teknisi';
    protected $fillable = ['nama_wilayah', 'ip_address'];

    public function teknisis()
    {
        return $this->belongsToMany(Teknisi::class, 'teknisi_wilayah', 'wilayah_teknisi_id', 'teknisi_id');
    }
}
