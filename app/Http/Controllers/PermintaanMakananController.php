<?php

namespace App\Http\Controllers;

use App\Models\PermintaanMakanan;
use App\Models\SubBidang;
use Illuminate\Http\Request;

class PermintaanMakananController extends Controller
{
    public function index()
    {
        $subBidang = SubBidang::all();
        $permintaanMakanan = PermintaanMakanan::with('subBidang')->latest()->get();
        return view('manajemen-data.makanan.index', compact('permintaanMakanan', 'subBidang'));
    }
}
