<?php

namespace App\Http\Controllers;

use App\Models\PermintaanKendaraan;
use App\Models\SubBidang;
use Illuminate\Http\Request;

class PermintaanKendaraanController extends Controller
{
    public function index()
    {
        $subBidang = SubBidang::all();
        $permintaanKendaraan = PermintaanKendaraan::with('subBidang')->latest()->get();
        return view('manajemen-data.kendaraan.index', compact('permintaanKendaraan', 'subBidang'));
    }
}
