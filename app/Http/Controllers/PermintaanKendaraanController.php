<?php

namespace App\Http\Controllers;

use App\Models\PermintaanKendaraan;
use App\Models\SubBidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Http;
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

         try {
        $response = Http::post('http://localhost:3000/send-group', [
            'groupId' => '120363421755577468@g.us', // ganti sesuai grup kamu
            'message' => "📢 Permintaan Kendaraan Baru:\n\n" .
                         "Nama: {$data['nama']}\n" .
                         "Lokasi Penjemputan: {$data['lokasi_penjemputan']}\n" .
                         "Tanggal: {$data['tanggal_waktu']}\n" .
                             "Lokasi: {$data['lokasi_penjemputan']}\n" 
        ]);

        if ($response->successful()) {
            \Log::info('Pesan WhatsApp berhasil dikirim', $response->json());
        } else {
            \Log::error('Gagal kirim WhatsApp: '.$response->body());
        }
    } catch (\Exception $e) {
        \Log::error('Error kirim WhatsApp: '.$e->getMessage());
    }

        return response()->json(['message' => 'Sukses']);
    }

    public function acc($id)
    {
        $peminjaman = PermintaanKendaraan::findOrFail($id);
        $peminjaman->status = 'approved';
        $peminjaman->save();

        $nomor = $this->normalizePhone($peminjaman->no_hp);

        $this->sendWhatsapp($nomor, "Permintaan kendaraan atas nama {$peminjaman->nama} telah *DITERIMA* ✅");

        return response()->json(['success' => true]);
    }

    public function tolak($id)
    {
        $peminjaman = PermintaanKendaraan::findOrFail($id);
        $peminjaman->status = 'rejected';
        $peminjaman->save();

        $nomor = $this->normalizePhone($peminjaman->no_hp);

    // Kirim chat via endpoint
        $this->sendWhatsapp($nomor, "Permintaan kendaraan atas nama {$peminjaman->nama}  *DITOLAK* ❌, Silahkan mengajukan kembali");

        return response()->json(['success' => true]);
    }

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
        $peminjaman = PermintaanKendaraan::findOrFail($id);

        // Hapus file jika ada
        if ($peminjaman->file) {
            Storage::disk('public')->delete($peminjaman->file);
        }

        $peminjaman->delete();

        return response()->json(['success' => true]);
    }
}
