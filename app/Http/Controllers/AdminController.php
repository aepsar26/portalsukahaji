<?php
// app/Http/Controllers/AdminController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statistic;
use App\Models\Budget;
use App\Models\Berita;
use App\Models\Layanan;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_statistics' => Statistic::count(),
            'active_budgets' => Budget::count(),
            'published_news' => Berita::count(),
            'available_services' => Layanan::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}