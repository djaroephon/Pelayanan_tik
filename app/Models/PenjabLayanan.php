<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenjabLayanan extends Model
{
    protected $table = 'penjab_layanan';

    protected $fillable = ['nama_penjab_layanan'];

    public function penyelesaians()
    {
        return $this->hasMany(Penyelesaian::class);
    }
}
