<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
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

            // Tambah 1 kunjungan
            $visit->increment('count');

            // Kirim ke view
            $view->with('todayCount', $visit->count);
        });
    }
}
