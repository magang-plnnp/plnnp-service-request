<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermintaanKendaraan;
use App\Models\PermintaanMakanan;

class DashboardController extends Controller
{
    public function index()
    {
        // Total permintaan kendaraan dan makanan
        $totalKendaraan = PermintaanKendaraan::count();
        $totalMakanan = PermintaanMakanan::count();

        // Statistik status
        $kendaraanPending = PermintaanKendaraan::where('status', 'pending')->count();
        $kendaraanApproved = PermintaanKendaraan::where('status', 'approved')->count();
        $kendaraanRejected = PermintaanKendaraan::where('status', 'rejected')->count();

        $makananPending = PermintaanMakanan::where('status', 'pending')->count();
        $makananApproved = PermintaanMakanan::where('status', 'approved')->count();
        $makananRejected = PermintaanMakanan::where('status', 'rejected')->count();

        return view('dashboard.index', compact(
            'totalKendaraan',
            'totalMakanan',
            'kendaraanPending',
            'kendaraanApproved',
            'kendaraanRejected',
            'makananPending',
            'makananApproved',
            'makananRejected'
        ));
    }
}
