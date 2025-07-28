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

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nid' => 'required|string|max:50',
            'sub_bidang_id' => 'required|exists:sub_bidang,id',
            'no_hp' => 'required|string|max:20',
            'lokasi_penjemputan' => 'required|string|max:255',
            'tanggal_waktu' => 'required|date',
            'tujuan' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
        ]);

        $data = $request->only([
            'nama',
            'nid',
            'sub_bidang_id',
            'no_hp',
            'lokasi_penjemputan',
            'tanggal_waktu',
            'tujuan'
        ]);

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('permintaan_kendaraan', 'public');
        }

        $data['status'] = 'pending';

        PermintaanKendaraan::create($data);

        return response()->json(['message' => 'Sukses']);
    }
}
