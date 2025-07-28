<?php

namespace App\Http\Controllers;

use App\Models\SubBidang;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $subBidang = SubBidang::all();
        return view('landing.index', compact('subBidang'));
    }
}
