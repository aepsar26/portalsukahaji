<?php
namespace App\Http\Controllers;

use App\Models\Budget;

class BudgetController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel budgets
        $budgets = Budget::all();

        // Kirim ke view transparansi.blade.php
        return view('pages.transparansi', compact('budgets'));
    }
}
