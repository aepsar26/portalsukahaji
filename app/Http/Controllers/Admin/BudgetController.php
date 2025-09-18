<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Budget;

class BudgetController extends Controller
{
    public function index()
    {
        $budgets = Budget::latest()->paginate(10);
        return view('admin.budgets.index', compact('budgets'));
    }

    public function create()
    {
        return view('admin.budgets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        Budget::create($request->only(['label', 'amount']));

        return redirect()->route('admin.budgets.index')
                        ->with('success', 'Anggaran berhasil ditambahkan');
    }

    public function edit(Budget $budget)
    {
        return view('admin.budgets.edit', compact('budget'));
    }

    public function update(Request $request, Budget $budget)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        $budget->update($request->only(['label', 'amount']));

        return redirect()->route('admin.budgets.index')
                        ->with('success', 'Anggaran berhasil diperbarui');
    }

    public function destroy(Budget $budget)
    {
        $budget->delete();

        return redirect()->route('admin.budgets.index')
                        ->with('success', 'Anggaran berhasil dihapus');
    }
}