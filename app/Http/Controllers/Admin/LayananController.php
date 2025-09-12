<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::latest()->get();
        return view('admin.layanans.index', compact('layanans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string'
        ]);

        Layanan::create($request->all());

        return redirect()->back()->with('success', 'Layanan berhasil ditambahkan!');
    }

    public function update(Request $request, Layanan $layanan)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string'
        ]);

        $layanan->update($request->all());

        return redirect()->back()->with('success', 'Layanan berhasil diperbarui!');
    }

    public function destroy(Layanan $layanan)
    {
        $layanan->delete();
        return redirect()->back()->with('success', 'Layanan berhasil dihapus!');
    }
}