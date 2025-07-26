<?php

namespace App\Http\Controllers;

use App\Models\SubBidang;
use Illuminate\Http\Request;

class SubBidangController extends Controller
{
    public function index()
    {
        $subbidangs = SubBidang::all();
        return view('sub_bidang.index', compact('subbidangs'));
    }

    public function create()
    {
        return view('sub_bidang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100',
        ]);

        SubBidang::create($request->only('nama'));

        return redirect()->route('sub-bidang.index')->with('success', 'Sub bidang created successfully.');
    }

    public function show($id)
    {
        $subbidang = SubBidang::findOrFail($id);
        return view('sub_bidang.show', compact('subbidang'));
    }

    public function edit($id)
    {
        $subbidang = SubBidang::findOrFail($id);
        return view('sub_bidang.edit', compact('subbidang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:100',
        ]);

        $subbidang = SubBidang::findOrFail($id);
        $subbidang->update($request->only('nama'));

        return redirect()->route('sub-bidang.index')->with('success', 'Sub bidang updated.');
    }

    public function destroy($id)
    {
        SubBidang::destroy($id);
        return redirect()->route('sub-bidang.index')->with('success', 'Sub bidang deleted.');
    }
}
