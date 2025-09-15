<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->paginate(10);
        return view('admin.beritas.index', compact('beritas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required',
            'date'    => 'required|date',
            'image'   => 'nullable|image|max:2048',
        ]);

        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('berita', 'public');
        }

        Berita::create([
            'title'   => $request->title,
            'content' => $request->conten,
            'date'    => $request->date,
            'image'   => $image,
        ]);

        return redirect()->route('admin.beritas.index')->with('success', 'Berita berhasil ditambahkan');
    }

    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required',
            'date'    => 'required|date',
            'image'   => 'nullable|image|max:2048',
        ]);

        $image = $berita->image;
        if ($request->hasFile('image')) {
            if ($image && Storage::disk('public')->exists($image)) {
                Storage::disk('public')->delete($image);
            }
            $image = $request->file('image')->store('berita', 'public');
        }

        $berita->update([
            'title'   => $request->title,
            'content' => $request->conten,
            'date'    => $request->date,
            'image'   => $image,
        ]);

        return redirect()->route('admin.beritas.index')->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy(Berita $berita)
    {
        if ($berita->image && Storage::disk('public')->exists($berita->image)) {
            Storage::disk('public')->delete($berita->image);
        }
        $berita->delete();

        return redirect()->route('admin.beritas.index')->with('success', 'Berita berhasil dihapus');
    }
}
