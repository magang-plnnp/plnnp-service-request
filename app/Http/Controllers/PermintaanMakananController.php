<?php

namespace App\Http\Controllers;

use App\Models\PermintaanMakanan;
use App\Models\SubBidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PermintaanMakananController extends Controller
{
    public function index()
    {
        $subBidang = SubBidang::all();
        $permintaanMakanan = PermintaanMakanan::with('subBidang')->latest()->get();
        return view('manajemen-data.makanan.index', compact('permintaanMakanan', 'subBidang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nid' => 'required|string|max:50',
            'sub_bidang_id' => 'required|exists:sub_bidang,id',
            'no_hp' => 'required|string|max:20',
            'judul_agenda' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'durasi' => 'required|string|max:50',
            'jumlah' => 'required|integer|min:1',
            'lokasi' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
        ]);

        $data = $request->only([
            'nama',
            'nid',
            'sub_bidang_id',
            'no_hp',
            'judul_agenda',
            'tanggal',
            'durasi',
            'jumlah',
            'lokasi',
        ]);

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('permintaan_makanan', 'public');
        }

        $data['status'] = 'pending';

        PermintaanMakanan::create($data);

        return response()->json(['message' => 'Sukses'], 200);
    }

    public function acc($id)
    {
        $peminjaman = PermintaanMakanan::findOrFail($id);
        $peminjaman->status = 'approved';
        $peminjaman->save();

        return response()->json(['success' => true]);
    }

    public function tolak($id)
    {
        $peminjaman = PermintaanMakanan::findOrFail($id);
        $peminjaman->status = 'rejected';
        $peminjaman->save();

        return response()->json(['success' => true]);
    }



    public function destroy($id)
    {
        $peminjaman = PermintaanMakanan::findOrFail($id);

        // Hapus file jika ada
        if ($peminjaman->file) {
            Storage::disk('public')->delete($peminjaman->file);
        }

        $peminjaman->delete();

        return response()->json(['success' => true]);
    }
}
