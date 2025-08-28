<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanMakanan extends Model
{
    use HasFactory;

    protected $table = 'permintaan_makanan';

    protected $fillable = [
        'nama',
        'nid',
        'sub_bidang_id',
        'no_hp',
        'judul_agenda',
        'tanggal',
        'durasi',
        'jumlah',
        'lokasi',
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

    public function durasi()
{
    return $this->belongsTo(Durasi::class);
}


    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
