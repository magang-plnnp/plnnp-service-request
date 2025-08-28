<?php

namespace App\Http\Controllers;

use App\Models\PermintaanMakanan;
use App\Models\SubBidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;


class PermintaanMakananController extends Controller
{
    public function index()
    {
    $subBidang = SubBidang::all();
    $permintaanMakanan = PermintaanMakanan::with('durasi')->get();
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
        'durasi' => 'required|exists:durasi,id',
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

    // Simpan ke DB
    $permintaan = PermintaanMakanan::create($data);

    // 🔹 Kirim notifikasi ke WhatsApp Group
    try {
        $response = Http::post('https://whatsapp-api-production-cb24.up.railway.app/send-group', [
            'groupId' => '120363421755577468@g.us', // ganti sesuai grup kamu
            'message' => "📢 Permintaan Makanan Baru:\n\n" .
                         "Nama: {$data['nama']}\n" .
                         "Judul Agenda: {$data['judul_agenda']}\n" .
                         "Tanggal: {$data['tanggal']}\n" .
                             "Lokasi: {$data['lokasi']}\n" .
                         "Jumlah: {$data['jumlah']}"
        ]);

        if ($response->successful()) {
            \Log::info('Pesan WhatsApp berhasil dikirim', $response->json());
        } else {
            \Log::error('Gagal kirim WhatsApp: '.$response->body());
        }
    } catch (\Exception $e) {
        \Log::error('Error kirim WhatsApp: '.$e->getMessage());
    }

    return response()->json(['message' => 'Sukses'], 200);
}


   public function acc($id)
{
    $peminjaman = PermintaanMakanan::findOrFail($id);
    $peminjaman->status = 'approved';
    $peminjaman->save();

    // Normalisasi nomor (misal kolomnya 'nomor_hp')
    $nomor = $this->normalizePhone($peminjaman->no_hp);

    // Kirim chat via endpoint
    $this->sendWhatsapp($nomor, "Permintaan makanan atas nama {$peminjaman->nama} telah *DITERIMA* ✅");

    return response()->json(['success' => true]);
}

public function tolak($id)
{
    $peminjaman = PermintaanMakanan::findOrFail($id);
    $peminjaman->status = 'rejected';
    $peminjaman->save();

    // Normalisasi nomor (misal kolomnya 'nomor_hp')
    $nomor = $this->normalizePhone($peminjaman->no_hp);

    // Kirim chat via endpoint
    $this->sendWhatsapp($nomor, "Permintaan makanan atas nama {$peminjaman->nama}  *DITOLAK* ❌, Silahkan mengajukan kembali");

    return response()->json(['success' => true]);
}

// Helper normalisasi nomor
private function normalizePhone($number)
{
    $number = preg_replace('/[^0-9]/', '', $number); // buang selain angka
    if (substr($number, 0, 1) === '0') {
        return '62' . substr($number, 1);
    }
    return $number;
}

// Helper untuk kirim WhatsApp
private function sendWhatsapp($number, $message)
{
    $endpoint = "http://localhost:3000/send-private"; // sesuaikan endpoint bot
    $client = new \GuzzleHttp\Client();

    try {
        $client->post($endpoint, [
            'json' => [
                'number' => $number,
                'message' => $message,
            ]
        ]);
    } catch (\Exception $e) {
        \Log::error("Gagal kirim WhatsApp ke {$number}: " . $e->getMessage());
    }
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
