<?php

namespace App\Http\Controllers;
use App\Models\Statistic;
use App\Models\Budget;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $statistics = Statistic::all();
        $budgets = Budget::all();
        return view('home', compact('statistics', 'budgets'));
    }
}
