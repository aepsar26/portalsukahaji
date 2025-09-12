<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->get();
        return view('admin.beritas.index', compact('beritas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'tanggal' => 'required|date'
        ]);

        Berita::create($request->all());

        return redirect()->back()->with('success', 'Berita berhasil ditambahkan!');
    }

    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'tanggal' => 'required|date'
        ]);

        $berita->update($request->all());

        return redirect()->back()->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(Berita $berita)
    {
        $berita->delete();
        return redirect()->back()->with('success', 'Berita berhasil dihapus!');
    }
}
