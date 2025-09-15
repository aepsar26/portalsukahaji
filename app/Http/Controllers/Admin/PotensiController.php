<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Potensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'title'       => 'required|string|max:255',
            'description' => 'required',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('potensis', 'public');
        }

        Potensi::create([
            'title'       => $request->title,
            'description' => $request->description,
            'image'       => $imagePath,
        ]);

        return redirect()->route('admin.potensis.index')->with('success', 'Potensi berhasil ditambahkan');
    }

    public function update(Request $request, Potensi $potensi)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = $potensi->image;
        if ($request->hasFile('image')) {
            if ($potensi->image && Storage::disk('public')->exists($potensi->image)) {
                Storage::disk('public')->delete($potensi->image);
            }
            $imagePath = $request->file('image')->store('potensis', 'public');
        }

        $potensi->update([
            'title'       => $request->title,
            'description' => $request->description,
            'image'       => $imagePath,
        ]);

        return redirect()->route('admin.potensis.index')->with('success', 'Potensi berhasil diperbarui');
    }

    public function destroy(Potensi $potensi)
    {
        if ($potensi->image && Storage::disk('public')->exists($potensi->image)) {
            Storage::disk('public')->delete($potensi->image);
        }

        $potensi->delete();
        return redirect()->route('admin.potensis.index')->with('success', 'Potensi berhasil dihapus');
    }
}
