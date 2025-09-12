<?php

namespace App\Http\Controllers;

use App\Models\Profil;

class ProfilController extends Controller
{
    public function index()
    {
        $profil = Profil::first(); // ambil data pertama
        return view('pages.profil', compact('profil'));
    }
}

