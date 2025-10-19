<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class wilayahTeknisi extends Model
{
    protected $table = 'wilayah_teknisi';

    protected $fillable = ['nama_wilayah', 'nama_pic', 'ip_address', 'guest_id'];

    // Tambahkan appends untuk accessor
    protected $appends = ['ip_addresses'];

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function teknisis()
    {
        return $this->belongsToMany(Teknisi::class, 'teknisi_wilayah', 'wilayah_teknisi_id', 'teknisi_id');
    }

    // Accessor untuk mendapatkan IP addresses sebagai array
    public function getIpAddressesAttribute()
    {
        return $this->ip_address ? array_map('trim', explode(',', $this->ip_address)) : [];
    }

    // Mutator untuk menyimpan IP addresses sebagai string dipisah koma
    public function setIpAddressAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['ip_address'] = implode(',', array_filter($value));
        } else {
            $this->attributes['ip_address'] = $value;
        }
    }
}
