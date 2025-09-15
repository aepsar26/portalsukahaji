<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        $profils = Profil::latest()->get();
        return view('admin.profils.index', compact('profils'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Profil::create($request->only('title', 'content'));

        return redirect()->route('admin.profils.index')->with('success', 'Profil berhasil ditambahkan');
    }

    public function update(Request $request, Profil $profil)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $profil->update($request->only('title', 'content'));

        return redirect()->route('admin.profils.index')->with('success', 'Profil berhasil diperbarui');
    }

    public function destroy(Profil $profil)
    {
        $profil->delete();

        return redirect()->route('admin.profils.index')->with('success', 'Profil berhasil dihapus');
    }
}
