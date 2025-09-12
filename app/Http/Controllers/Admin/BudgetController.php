<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Budget;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function index()
    {
        $budgets = Budget::latest()->get();
        return view('admin.budgets.index', compact('budgets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'amount' => 'required|string|max:255'
        ]);

        Budget::create($request->all());

        return redirect()->back()->with('success', 'Anggaran berhasil ditambahkan!');
    }

    public function update(Request $request, Budget $budget)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'amount' => 'required|string|max:255'
        ]);

        $budget->update($request->all());

        return redirect()->back()->with('success', 'Anggaran berhasil diperbarui!');
    }

    public function destroy(Budget $budget)
    {
        $budget->delete();
        return redirect()->back()->with('success', 'Anggaran berhasil dihapus!');
    }
}