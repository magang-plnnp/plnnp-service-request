<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanKendaraan extends Model
{
    use HasFactory;

    protected $table = 'permintaan_kendaraan';

    protected $fillable = [
        'nama',
        'nid',
        'sub_bidang_id',
        'no_hp',
        'lokasi_penjemputan',
        'tanggal_waktu',
        'tujuan',
        'file',
        'status',
        'approved_by',
        'approved_at',
    ];

    // Relasi
    public function subBidang()
    {
        return $this->belongsTo(SubBidang::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
