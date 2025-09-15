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
            'type'   => 'required|string|max:255',
            'amount' => 'required|numeric',
        ]);

        Transparansi::create($request->all());

        return redirect()->route('admin.transparansis.index')
                         ->with('success', 'Data transparansi berhasil ditambahkan.');
    }

    public function update(Request $request, Transparansi $transparansi)
    {
        $request->validate([
            'type'   => 'required|string|max:255',
            'amount' => 'required|numeric',
        ]);

        $transparansi->update($request->all());

        return redirect()->route('admin.transparansis.index')
                         ->with('success', 'Data transparansi berhasil diperbarui.');
    }

    public function destroy(Transparansi $transparansi)
    {
        $transparansi->delete();

        return redirect()->route('admin.transparansis.index')
                         ->with('success', 'Data transparansi berhasil dihapus.');
    }
}
