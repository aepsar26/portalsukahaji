<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemerintahan;
use Illuminate\Http\Request;

class PemerintahanController extends Controller
{
    public function index()
    {
        $pemerintahans = Pemerintahan::latest()->get();
        return view('admin.pemerintahans.index', compact('pemerintahans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string'
        ]);

        Pemerintahan::create($request->all());

        return redirect()->back()->with('success', 'Data pemerintahan berhasil ditambahkan!');
    }

    public function update(Request $request, Pemerintahan $pemerintahan)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string'
        ]);

        $pemerintahan->update($request->all());

        return redirect()->back()->with('success', 'Data pemerintahan berhasil diperbarui!');
    }

    public function destroy(Pemerintahan $pemerintahan)
    {
        $pemerintahan->delete();
        return redirect()->back()->with('success', 'Data pemerintahan berhasil dihapus!');
    }
}