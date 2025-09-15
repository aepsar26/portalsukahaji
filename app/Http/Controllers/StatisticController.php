<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    /**
     * Tampilkan daftar statistik
     */
    public function index()
    {
        $statistics = Statistic::latest()->get();
        return view('admin.statistics.index', compact('statistics'));
    }

    /**
     * Simpan data statistik baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|integer',
        ]);

        Statistic::create([
            'label' => $request->label,
            'value' => $request->value,
        ]);

       return redirect()->route('admin.statistics.index')->with('success', 'Data berhasil disimpan!');

    }

    /**
     * Update data statistik
     */
    public function update(Request $request, Statistic $statistic)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|integer',
        ]);

        $statistic->update([
            'label' => $request->label,
            'value' => $request->value,
        ]);

        return redirect()->route('admin.statistics.index')
                         ->with('success', 'Statistik berhasil diperbarui!');
    }

    /**
     * Hapus data statistik
     */
    public function destroy(Statistic $statistic)
    {
        $statistic->delete();

        return redirect()->route('admin.statistics.index')
                         ->with('success', 'Statistik berhasil dihapus!');
    }
}
