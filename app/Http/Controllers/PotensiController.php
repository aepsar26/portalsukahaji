<?php

namespace App\Http\Controllers;

use App\Models\Potensi;

use Illuminate\Http\Request;

class PotensiController extends Controller
{
    public function index()
    {
        $potensis = Potensi::all(); // atau bisa pakai orderBy/filter sesuai kebutuhan

        return view('pages.potensi', compact('potensis'));
    }
}
