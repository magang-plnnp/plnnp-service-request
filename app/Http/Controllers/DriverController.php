<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $driver = Driver::all();
        return view('manajemen-data.driver.index', compact('driver'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_driver' => 'required|string|max:100',
            'nomer_telepon' => 'required|string|max:20',
        ]);

        Driver::create([
            'nama_driver' => $request->nama_driver,
            'nomer_telepon' => $request->nomer_telepon,
        ]);

        return response()->json(['message' => 'Driver berhasil ditambahkan!']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_driver' => 'required|string|max:100',
            'nomer_telepon' => 'required|string|max:20',
        ]);

        $driver = Driver::findOrFail($id);
        $driver->update([
            'nama_driver' => $request->nama_driver,
            'nomer_telepon' => $request->nomer_telepon,
        ]);

        return response()->json(['message' => 'Data driver berhasil diperbarui!']);
    }

    public function destroy($id)
    {
        $driver = Driver::findOrFail($id);
        $driver->delete();

        return response()->json(['message' => 'Driver berhasil dihapus!']);
    }
}
