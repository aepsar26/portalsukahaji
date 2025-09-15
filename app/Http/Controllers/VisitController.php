<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use Carbon\Carbon;

class VisitController extends Controller
{
    public function trackVisit()
    {
        $today = Carbon::today()->toDateString();

        // Ambil data hari ini atau buat baru
        $visit = Visit::firstOrCreate(
            ['visit_date' => $today],
            ['count' => 0]
        );

        // Tambah 1 kunjungan
        $visit->increment('count');

        return response()->json(['count' => $visit->count]);
    }

    public function showTodayVisit()
    {
        $todayCount = Visit::whereDate('visit_date', today())->sum('count');

        return view('admin.visits', compact('todayCount'));
    }
}
