<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Models\Visit;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // View composer untuk header
        View::composer('components.header', function ($view) {

            $today = Carbon::today()->toDateString();

            // Ambil atau buat record hari ini
            $visit = Visit::firstOrCreate(
                ['visit_date' => $today],
                ['count' => 0]
            );

            // Cek session, agar satu device hanya dihitung 1 kali per hari
            if (!Session::has('visit_counted_' . $today)) {
                $visit->increment('count');
                Session::put('visit_counted_' . $today, true); // tandai sudah dihitung
            }

            // Kirim ke view
            $view->with('todayCount', $visit->count);
        });
    }
}
