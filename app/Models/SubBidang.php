<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubBidang extends Model
{
    use HasFactory;

    protected $table = 'sub_bidang';
    protected $fillable = ['nama'];

    // Relasi
    public function permintaanKendaraan()
    {
        return $this->hasMany(PermintaanKendaraan::class);
    }

    public function permintaanMakanan()
    {
        return $this->hasMany(PermintaanMakanan::class);
    }
}
