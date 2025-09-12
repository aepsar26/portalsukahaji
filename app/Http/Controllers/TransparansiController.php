<?php

namespace App\Http\Controllers;

use App\Models\Transparansi;
use Illuminate\Http\Request;

class TransparansiController extends Controller
{
    public function index()
    {
        $transparansis = Transparansi::all();

        return view('pages.transparansi', compact('transparansis'));
    }
}
