<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Durasi extends Model
{
    use HasFactory;

    protected $table = 'durasi'; 

    protected $fillable = [
        'nama',
        'keterangan',
    ];
}
