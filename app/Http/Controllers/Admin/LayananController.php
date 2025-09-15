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
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Layanan::create($request->only('title', 'description'));

        return redirect()->route('admin.layanans.index')->with('success', 'Layanan berhasil ditambahkan');
    }

    public function update(Request $request, Layanan $layanan)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $layanan->update($request->only('title', 'description'));

        return redirect()->route('admin.layanans.index')->with('success', 'Layanan berhasil diperbarui');
    }

    public function destroy(Layanan $layanan)
    {
        $layanan->delete();
        return redirect()->route('admin.layanans.index')->with('success', 'Layanan berhasil dihapus');
    }
}
