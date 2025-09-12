<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Statistic;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index()
    {
        $statistics = Statistic::latest()->get();
        return view('admin.statistics.index', compact('statistics'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|integer|min:0'
        ]);

        Statistic::create($request->all());

        return redirect()->back()->with('success', 'Statistik berhasil ditambahkan!');
    }

    public function update(Request $request, Statistic $statistic)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|integer|min:0'
        ]);

        $statistic->update($request->all());

        return redirect()->back()->with('success', 'Statistik berhasil diperbarui!');
    }

    public function destroy(Statistic $statistic)
    {
        $statistic->delete();
        return redirect()->back()->with('success', 'Statistik berhasil dihapus!');
    }
}