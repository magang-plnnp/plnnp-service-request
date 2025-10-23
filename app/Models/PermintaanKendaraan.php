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
        'keperluan',
        'kendaraan_id',
        'driver_id',
        'file',
        'status',
        'keterangan',
        'approved_by',
        'approved_at',
    ];

    public function subBidang()
    {
        return $this->belongsTo(SubBidang::class);
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
