<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemerintahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PemerintahanController extends Controller
{
    public function index()
    {
        // Ambil Kepala Kelurahan (misal berdasarkan posisi)
        $kepala = Pemerintahan::where('position', 'Lurah Sukahaji')->first();

        // Jika juga ingin menampilkan semua pejabat
        $pemerintahans = Pemerintahan::latest()->get();

        return view('admin.pemerintahans.index', compact('kepala', 'pemerintahans'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'position'    => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['name', 'position', 'description']);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('pemerintahans', 'public');
        }

        Pemerintahan::create($data);

        return redirect()->route('admin.pemerintahans.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, Pemerintahan $pemerintahan)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'position'    => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['name', 'position', 'description']);

        if ($request->hasFile('photo')) {
            if ($pemerintahan->photo) {
                Storage::disk('public')->delete($pemerintahan->photo);
            }
            $data['photo'] = $request->file('photo')->store('pemerintahans', 'public');
        }

        $pemerintahan->update($data);

        return redirect()->route('admin.pemerintahans.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(Pemerintahan $pemerintahan)
    {
        if ($pemerintahan->photo) {
            Storage::disk('public')->delete($pemerintahan->photo);
        }

        $pemerintahan->delete();
        return redirect()->route('admin.pemerintahans.index')->with('success', 'Data berhasil dihapus!');
    }
}
