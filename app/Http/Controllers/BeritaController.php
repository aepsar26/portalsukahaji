<?php
// app/Http/Controllers/BeritaController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->paginate(10);
        return view('admin.beritas.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.beritas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['title', 'content', 'date']);
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('beritas', 'public');
        }

        Berita::create($data);

        return redirect()->route('admin.beritas.index')
                        ->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit(Berita $berita)
    {
        return view('admin.beritas.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['title', 'content', 'date']);
        
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($berita->image) {
                Storage::delete('public/' . $berita->image);
            }
            $data['image'] = $request->file('image')->store('beritas', 'public');
        }

        $berita->update($data);

        return redirect()->route('admin.beritas.index')
                        ->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy(Berita $berita)
    {
        if ($berita->image) {
            Storage::delete('public/' . $berita->image);
        }
        
        $berita->delete();

        return redirect()->route('admin.beritas.index')
                        ->with('success', 'Berita berhasil dihapus');
    }
}