<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;

class JenisKendaraanController extends Controller
{
    public function index()
    {
        $kendaraan = Kendaraan::all();
        return view('manajemen-data.jeniskendaraan.index', compact('kendaraan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kendaraan' => 'required|string|max:255',
        ]);

        Kendaraan::create([
            'nama_kendaraan' => $request->nama_kendaraan,
        ]);

        return response()->json(['success' => true, 'message' => 'Jenis kendaraan berhasil ditambahkan.']);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_kendaraan' => 'required|string|max:255',
        ]);

        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->update([
            'nama_kendaraan' => $request->nama_kendaraan,
        ]);

        return response()->json(['success' => true, 'message' => 'Data kendaraan berhasil diperbarui.']);
    }

    public function destroy(string $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->delete();

        return response()->json(['success' => true, 'message' => 'Data kendaraan berhasil dihapus.']);
    }
}
