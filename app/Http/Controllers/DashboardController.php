<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermintaanKendaraan;
use App\Models\PermintaanMakanan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $lastMonth = $now->copy()->subMonth();

        // ==== Total permintaan keseluruhan ====
        $totalKendaraan = PermintaanKendaraan::count();
        $totalMakanan = PermintaanMakanan::count();

        $totalKendaraanThisMonth = $this->countTotalThisMonth(PermintaanKendaraan::class, $now);
        $totalKendaraanLastMonth = $this->countTotalThisMonth(PermintaanKendaraan::class, $lastMonth);
        $totalKendaraanPercentage = $this->calculatePercentage($totalKendaraanThisMonth, $totalKendaraanLastMonth);

        $totalMakananThisMonth = $this->countTotalThisMonth(PermintaanMakanan::class, $now);
        $totalMakananLastMonth = $this->countTotalThisMonth(PermintaanMakanan::class, $lastMonth);
        $totalMakananPercentage = $this->calculatePercentage($totalMakananThisMonth, $totalMakananLastMonth);

        // ==== Statistik status Kendaraan ====
        $kendaraanPending = PermintaanKendaraan::where('status', 'pending')->count();
        $kendaraanApproved = PermintaanKendaraan::where('status', 'approved')->count();
        $kendaraanRejected = PermintaanKendaraan::where('status', 'rejected')->count();

        $kendaraanPendingPercentage = $this->calculateStatusPercentage(PermintaanKendaraan::class, 'pending', $now, $lastMonth);
        $kendaraanApprovedPercentage = $this->calculateStatusPercentage(PermintaanKendaraan::class, 'approved', $now, $lastMonth);
        $kendaraanRejectedPercentage = $this->calculateStatusPercentage(PermintaanKendaraan::class, 'rejected', $now, $lastMonth);

        // ==== Statistik status Makanan ====
        $makananPending = PermintaanMakanan::where('status', 'pending')->count();
        $makananApproved = PermintaanMakanan::where('status', 'approved')->count();
        $makananRejected = PermintaanMakanan::where('status', 'rejected')->count();

        $makananPendingPercentage = $this->calculateStatusPercentage(PermintaanMakanan::class, 'pending', $now, $lastMonth);
        $makananApprovedPercentage = $this->calculateStatusPercentage(PermintaanMakanan::class, 'approved', $now, $lastMonth);
        $makananRejectedPercentage = $this->calculateStatusPercentage(PermintaanMakanan::class, 'rejected', $now, $lastMonth);

        // ==== Aktivitas terbaru ====
        $kendaraan = PermintaanKendaraan::latest()->limit(3)->get()->map(function ($item) {
            $item->jenis = 'Kendaraan';
            return $item;
        });

        $makanan = PermintaanMakanan::latest()->limit(3)->get()->map(function ($item) {
            $item->jenis = 'Makanan';
            return $item;
        });

        $aktivitasTerbaru = $kendaraan->concat($makanan)->sortByDesc('created_at')->values();

        return view('dashboard.index', compact(
            'totalKendaraan',
            'totalMakanan',
            'totalKendaraanPercentage',
            'totalMakananPercentage',

            'kendaraanPending',
            'kendaraanApproved',
            'kendaraanRejected',

            'makananPending',
            'makananApproved',
            'makananRejected',

            'kendaraanPendingPercentage',
            'kendaraanApprovedPercentage',
            'kendaraanRejectedPercentage',

            'makananPendingPercentage',
            'makananApprovedPercentage',
            'makananRejectedPercentage',

            'aktivitasTerbaru'
        ));
    }

    private function calculatePercentage($thisMonth, $lastMonth)
    {
        if ($lastMonth == 0) {
            return $thisMonth > 0 ? 100 : 0;
        }

        return round((($thisMonth - $lastMonth) / $lastMonth) * 100, 2);
    }

    private function countStatusThisMonth($model, $status, $date)
    {
        return $model::where('status', $status)
            ->whereMonth('created_at', $date->month)
            ->whereYear('created_at', $date->year)
            ->count();
    }

    private function countTotalThisMonth($model, $date)
    {
        return $model::whereMonth('created_at', $date->month)
            ->whereYear('created_at', $date->year)
            ->count();
    }

    private function calculateStatusPercentage($model, $status, $now, $lastMonth)
    {
        $thisMonthCount = $this->countStatusThisMonth($model, $status, $now);
        $lastMonthCount = $this->countStatusThisMonth($model, $status, $lastMonth);
        return $this->calculatePercentage($thisMonthCount, $lastMonthCount);
    }
}
