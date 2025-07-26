<?php

namespace App\Http\Controllers;

use App\Models\PermintaanKendaraan;
use Illuminate\Http\Request;

class PermintaanKendaraanController extends Controller
{
    public function index()
    {
        $permintaanKendaraan = PermintaanKendaraan::latest()->get();
        return view('manajemen-data.kendaraan.index', compact('permintaanKendaraan'));
    }
}
