<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transparansi;
use Illuminate\Http\Request;

class TransparansiController extends Controller
{
    public function index()
    {
        $transparansis = Transparansi::latest()->get();
        return view('admin.transparansis.index', compact('transparansis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0'
        ]);

        Transparansi::create($request->all());

        return redirect()->back()->with('success', 'Data transparansi berhasil ditambahkan!');
    }

    public function update(Request $request, Transparansi $transparansi)
    {
        $request->validate([
            'jenis' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0'
        ]);

        $transparansi->update($request->all());

        return redirect()->back()->with('success', 'Data transparansi berhasil diperbarui!');
    }

    public function destroy(Transparansi $transparansi)
    {
        $transparansi->delete();
        return redirect()->back()->with('success', 'Data transparansi berhasil dihapus!');
    }
}