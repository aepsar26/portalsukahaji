<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use App\Models\Budget;
use App\Models\Pemerintahan;
use App\Models\Visit;
use App\Models\Slider; // tambahkan ini
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // Kepala kelurahan
        $kepala = Pemerintahan::where('position', 'like', '%kepala%')->first();

        // Statistik kependudukan
        $statistics = Statistic::all();

        // Anggaran
        $budgets = Budget::all();

        // Sliders (background hero dinamis)
        $sliders = Slider::all();

        // ----- TRACKING KUNJUNGAN HARI INI -----
        $today = Carbon::today()->toDateString();

        // Ambil record hari ini atau buat baru
        $visit = Visit::firstOrCreate(
            ['visit_date' => $today],
            ['count' => 0]
        );

        // Tambah 1 kunjungan
        $visit->increment('count');

        // Ambil jumlah kunjungan hari ini
        $todayCount = $visit->count;

        // ----- END TRACKING -----

        return view('home', compact('kepala', 'statistics', 'budgets', 'todayCount', 'sliders'));
    }
}
