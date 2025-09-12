<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Potensi;
use Illuminate\Http\Request;

class PotensiController extends Controller
{
    public function index()
    {
        $potensis = Potensi::latest()->get();
        return view('admin.potensis.index', compact('potensis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string'
        ]);

        Potensi::create($request->all());

        return redirect()->back()->with('success', 'Potensi berhasil ditambahkan!');
    }

    public function update(Request $request, Potensi $potensi)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string'
        ]);

        $potensi->update($request->all());

        return redirect()->back()->with('success', 'Potensi berhasil diperbarui!');
    }

    public function destroy(Potensi $potensi)
    {
        $potensi->delete();
        return redirect()->back()->with('success', 'Potensi berhasil dihapus!');
    }
}