<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class PelayananController extends Controller
{
    public function index()
    {
        // ambil semua data dari tabel layanans
        $layanans = Layanan::all();

        // kirim ke view dengan variabel $layanans
        return view('pages.pelayanan', compact('layanans'));
    }
}
