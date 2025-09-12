<?php

namespace App\Http\Controllers;

use App\Models\Pemerintahan;

class PemerintahanController extends Controller
{
    public function index()
    {
        $pemerintahan = Pemerintahan::all();
        return view('pages.pemerintahan', compact('pemerintahan'));
    }
}
