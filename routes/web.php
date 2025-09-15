<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\PemerintahanController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\TransparansiController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\PotensiController;
use App\Http\Controllers\VisitController;


Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

// Admin Routes Group
Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Statistics
    Route::resource('statistics', StatisticController::class);
    
    // Budgets
    Route::resource('budgets', BudgetController::class);
    
    // Profils
    Route::resource('profils', ProfilController::class)->except(['create', 'edit', 'show']);
    
    // Pemerintahan
    Route::resource('pemerintahans', PemerintahanController::class)->except(['create', 'edit', 'show']);
    
    // Layanan
   Route::resource('layanans', LayananController::class)->except(['create', 'edit', 'show']);
    
    // Transparansi
    Route::resource('transparansis', TransparansiController::class)->except(['create', 'edit', 'show']);
    
    // Berita
    Route::resource('beritas', BeritaController::class)->except(['create', 'edit', 'show']);
    
    // Potensi
    Route::resource('potensis', PotensiController::class)->except(['create', 'edit', 'show']);
});

Route::get('/track-visit', [VisitController::class, 'trackVisit']); 
Route::get('/admin/visits', [VisitController::class, 'showTodayVisit'])->name('admin.visits');

Route::get('beranda', [App\Http\Controllers\HomeController::class, 'index'])->name('beranda');

Route::get('/profil', [App\Http\Controllers\ProfilController::class, 'index'])->name('profil');
Route::get('/pemerintahan', [App\Http\Controllers\PemerintahanController::class, 'index'])->name('pemerintahan');
Route::get('/pelayanan', [App\Http\Controllers\PelayananController::class, 'index'])->name('pelayanan');
Route::get('/transparansi', [App\Http\Controllers\TransparansiController::class, 'index'])->name('transparansi');
Route::get('/berita', [App\Http\Controllers\BeritaController::class, 'index'])->name('berita');
Route::get('/potensi', [App\Http\Controllers\PotensiController::class, 'index'])->name('potensi');


Route::get('/peta-kelurahan', function () {
    return view('pages.peta');
})->name('peta');

Route::get('/struktur-organisasi', function () {
    return view('pages.struktur');
})->name('struktur');

Route::get('/persuratan-online', function () {
    return view('pages.persuratan');
})->name('persuratan');

Route::get('/agenda-kegiatan', function () {
    return view('pages.agenda');
})->name('agenda');

Route::get('/pengaduan-online', function () {
    return view('pages.pengaduan');
})->name('pengaduan');

Route::get('/download-formulir', function () {
    return view('pages.formulir');
})->name('formulir');
