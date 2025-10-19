<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relokasi extends Model
{
    use HasFactory;

    protected $table = 'relokasi';

    protected $fillable = [
        'guest_id',
        'nama_pemohon',
        'nip',
        'instansi',
        'jenis_relokasi',
        'nama_alat_jaringan',
        'keterangan',
        'ip_address',
        'instansi_awal',
        'koordinat_awal',
        'instansi_tujuan',
        'koordinat_tujuan',
        'surat_bukti_izin_relokasi',
        'status',
        'keterangan_admin',
        'teknisi_id',
    ];

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function teknisi()
    {
        return $this->belongsTo(Teknisi::class);
    }

    public function penjab()
    {
        return $this->belongsTo(PenjabLayanan::class);
    }

    // Scope untuk status
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeOnProgress($query)
    {
        return $query->where('status', 'on progress');
    }

    public function scopeComplete($query)
    {
        return $query->where('status', 'complete');
    }
}
