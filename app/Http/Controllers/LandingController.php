<?php

namespace App\Http\Controllers;

use App\Models\SubBidang;
use App\Models\Durasi;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $subBidang = SubBidang::all();
        $durasi = Durasi::all(); 
        return view('landing.index', compact('subBidang', 'durasi'));
    }
}
