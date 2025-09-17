<?php

namespace App\Http\Controllers;

use App\Models\Pemerintahan;
use Illuminate\Http\Request;

class StrukturController extends Controller
{
   public function index()
{
    $kepala = Pemerintahan::where('position', 'LIKE', '%Kepala Kelurahan%')->first();

    // Sekretaris (bisa "Sekretaris", "Sekretaris Kelurahan", dll)
    $sekretaris = Pemerintahan::where('position', 'LIKE', '%Sekretaris%')->first();

    // Kepala Seksi (termasuk yang ada embel2 "PLT.")
    $kepalaSeksi = Pemerintahan::where('position', 'LIKE', '%Kepala Seksi%')->get();

    // Staff
    $staff = Pemerintahan::where('position', 'LIKE', '%Staff%')->get();

    return view('pages.struktur', compact('kepala', 'sekretaris', 'kepalaSeksi', 'staff'));
}

}
