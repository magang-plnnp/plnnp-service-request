<?php

namespace App\Http\Controllers;

use App\Models\PermintaanKendaraan;
use App\Models\SubBidang;
use App\Models\Driver;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class PermintaanKendaraanController extends Controller
{
    public function index()
    {
        $subBidang = SubBidang::all();
        $drivers = Driver::all();
        $kendaraan = Kendaraan::all();
        $permintaanKendaraan = PermintaanKendaraan::with(['subBidang', 'kendaraan', 'driver'])->latest()->get();

        return view('manajemen-data.kendaraan.index', compact('permintaanKendaraan', 'subBidang', 'drivers', 'kendaraan'));
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
            'keperluan' => 'required|string|max:255',
            'kendaraan_id' => 'required|exists:kendaraan,id',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
        ]);

        $data = $request->only([
            'nama',
            'nid',
            'sub_bidang_id',
            'no_hp',
            'lokasi_penjemputan',
            'tanggal_waktu',
            'tujuan',
            'keperluan',
            'kendaraan_id'
        ]);

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('permintaan_kendaraan', 'public');
        }

        $data['status'] = 'pending';

        // Simpan ke database dan ambil data relasinya
        $permintaan = PermintaanKendaraan::create($data);

        // Kirim notifikasi WhatsApp ke grup
        try {
            $subBidangNama = $permintaan->subBidang ? $permintaan->subBidang->nama : '-';
            $kendaraanNama = $permintaan->kendaraan ? $permintaan->kendaraan->nama_kendaraan : '-';
            $formattedDateTime = Carbon::parse($permintaan->tanggal_waktu)->format('d-m-Y H:i') . ' WIB';;
            $response = Http::post('http://lomba.uppaiton.my.id/send.php', [
                'chatId' => '120363421755577468@g.us', // ID grup WhatsApp
                'text'   => "📢 Permintaan Kendaraan Baru\n\n" .
                            "Nama: {$permintaan->nama}\n" .
                            "NID: {$permintaan->nid}\n" .
                            "Sub Bidang: {$subBidangNama}\n" .
                            "No WhatsApp: {$permintaan->no_hp}\n" .
                            "Tanggal & Waktu: {$formattedDateTime}\n" .
                            "Lokasi Penjemputan: {$permintaan->lokasi_penjemputan}\n" .
                            "Tujuan Perjalanan: {$permintaan->tujuan}\n" .
                            "Keperluan: {$permintaan->keperluan}\n" .
                            "Jenis Kendaraan: {$kendaraanNama}\n"
            ]);

            if ($response->successful()) {
                \Log::info('Pesan WhatsApp berhasil dikirim', $response->json());
            } else {
                \Log::error('Gagal kirim WhatsApp: ' . $response->body());
            }
        } catch (\Exception $e) {
            \Log::error('Error kirim WhatsApp: ' . $e->getMessage());
        }

        return response()->json(['message' => 'Sukses']);
    }

    public function acc(Request $request, $id)
    {
        $request->validate([
            'driver_id' => 'required|exists:driver,id',
        ]);

        $peminjaman = PermintaanKendaraan::findOrFail($id);
        $peminjaman->status = 'approved';
        $peminjaman->driver_id = $request->driver_id;
        $peminjaman->save();
        $driver = Driver::find($request->driver_id);
        $nomor = $this->normalizePhone($peminjaman->no_hp);

        $this->sendWhatsapp($nomor, 
            "Permintaan kendaraan atas nama *{$peminjaman->nama}* telah *DITERIMA* ✅\n" .
            "🚗 Driver yang ditugaskan:\n" .
            "Nama: {$driver->nama_driver}\n" .
            "Nomor HP: {$driver->nomer_telepon}"
        );

        return response()->json(['success' => true]);
    }

    public function tolak(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required|string|max:255'
        ]);

        $peminjaman = PermintaanKendaraan::findOrFail($id);
        $peminjaman->status = 'rejected';
        $peminjaman->keterangan = $request->keterangan;
        $peminjaman->save();
        $nomor = $this->normalizePhone($peminjaman->no_hp);

        $pesan = "Permintaan kendaraan atas nama *{$peminjaman->nama}* *DITOLAK* ❌\n" .
                "📋 Alasan Penolakan:\n" .
                "{$peminjaman->keterangan}";

        $this->sendWhatsapp($nomor, $pesan);

        return response()->json(['success' => true]);
    }

    private function normalizePhone($number)
    {
        $number = preg_replace('/[^0-9]/', '', $number);
        if (substr($number, 0, 1) === '0') {
            return '62' . substr($number, 1);
        }
        return $number;
    }

    private function sendWhatsapp($number, $message)
    {
        $endpoint = "http://lomba.uppaiton.my.id/send.php";
        $client = new \GuzzleHttp\Client();

        try {
            $client->post($endpoint, [
                'json' => [
                    'chatId' => "{$number}@c.us",
                    'text'   => $message,
                ],
                'headers' => [
                    'Content-Type' => 'application/json'
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error("Gagal kirim WhatsApp ke {$number}: " . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $peminjaman = PermintaanKendaraan::findOrFail($id);

        if ($peminjaman->file) {
            Storage::disk('public')->delete($peminjaman->file);
        }

        $peminjaman->delete();

        return response()->json(['success' => true]);
    }
}
