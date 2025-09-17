<?php

// app/Http/Controllers/BeritaController.php
namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->get();
        return view('pages.berita', compact('beritas'));
    }
}
