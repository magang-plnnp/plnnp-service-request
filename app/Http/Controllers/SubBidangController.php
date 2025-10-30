<?php

namespace App\Http\Controllers;

use App\Models\SubBidang;
use Illuminate\Http\Request;

class SubBidangController extends Controller
{
    // Tampilkan halaman utama
    public function index()
    {
        $subbidang = SubBidang::all();
        return view('manajemen-data.subbidang.index', compact('subbidang'));
    }

    // Simpan data baru (AJAX)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|max:100',
        ]);

        $subbidang = SubBidang::create($validated);

        return response()->json([
            'message' => 'Sub bidang berhasil ditambahkan.',
            'data' => $subbidang
        ], 201);
    }

    // Update data (AJAX)
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|max:100',
        ]);

        $subbidang = SubBidang::findOrFail($id);
        $subbidang->update($validated);

        return response()->json([
            'message' => 'Sub bidang berhasil diperbarui.',
            'data' => $subbidang
        ]);
    }

    // Hapus data (AJAX)
    public function destroy($id)
    {
        $subbidang = SubBidang::findOrFail($id);
        $subbidang->delete();

        return response()->json([
            'message' => 'Sub bidang berhasil dihapus.'
        ]);
    }
}
