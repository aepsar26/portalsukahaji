<?php

namespace App\Http\Controllers;

use App\Models\Pemerintahan;

class PemerintahanController extends Controller
{


    public function index()
    {
        $pemerintahans = Pemerintahan::all();
        return view('pages.pemerintahan', compact('pemerintahans'));
    }

}
