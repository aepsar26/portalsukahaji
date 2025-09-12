<?php
// app/Http/Controllers/Admin/DashboardController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Statistic;
use App\Models\Budget;
use App\Models\Berita;
use App\Models\Layanan;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_statistics' => Statistic::count(),
            'total_budgets' => Budget::count(),
            'total_news' => Berita::count(),
            'total_services' => Layanan::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}