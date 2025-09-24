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
}
