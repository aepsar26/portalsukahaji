<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\Admin\BudgetController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\PemerintahanController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\TransparansiController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\PotensiController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\StrukturController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\Admin\KegiatanController as AdminKegiatanController;
use App\Http\Controllers\Admin\ProfileController;

// ===================
// 🌍 Public Routes
// ===================
Route::get('/', [HomeController::class, 'index'])->name('beranda');
Route::get('/beranda', [HomeController::class, 'index'])->name('beranda');

Route::get('/profil', [App\Http\Controllers\ProfilController::class, 'index'])->name('profil');
Route::get('/pemerintahan', [App\Http\Controllers\PemerintahanController::class, 'index'])->name('pemerintahan');
Route::get('/pelayanan', [App\Http\Controllers\PelayananController::class, 'index'])->name('pelayanan');
Route::get('/transparansi', [App\Http\Controllers\BudgetController::class, 'index'])->name('transparansi');
Route::get('/berita', [App\Http\Controllers\BeritaController::class, 'index'])->name('berita');
Route::get('/potensi', [App\Http\Controllers\PotensiController::class, 'index'])->name('potensi');

Route::get('/peta-kelurahan', fn() => view('pages.peta'))->name('peta');
Route::get('/struktur', [StrukturController::class, 'index'])->name('struktur');

Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
Route::get('/kegiatan/{slug}', [KegiatanController::class, 'show'])->name('kegiatan.show');

Route::get('/persuratan-online', fn() => view('pages.persuratan'))->name('persuratan');
Route::get('/agenda-kegiatan', fn() => view('pages.agenda'))->name('agenda');
Route::get('/pengaduan-online', fn() => view('pages.pengaduan'))->name('pengaduan');
Route::get('/download-formulir', fn() => view('pages.formulir'))->name('formulir');

// Track Visit
Route::get('/track-visit', [VisitController::class, 'trackVisit']);
Route::get('/admin/visits', [VisitController::class, 'showTodayVisit'])->name('admin.visits');

// ===================
// 🔑 Authentication Routes (tanpa middleware)
// ===================
Route::prefix('admin')->name('admin.')->group(function () {
    // Kalau akses /admin langsung → arahkan ke login
    Route::get('/login', function () {
    return redirect()->route('admin.login');
    })->name('login');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// ===================
// 🛠️ Admin Routes (Protected by auth middleware)
// ===================
// Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
//     Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
//     Route::post('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
// });

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    // ... route lain
    Route::resource('statistics', StatisticController::class);
    Route::resource('budgets', BudgetController::class);
    Route::resource('profils', ProfilController::class)->except(['create', 'edit', 'show']);
    Route::resource('pemerintahans', PemerintahanController::class)->except(['create', 'edit', 'show']);
    Route::resource('layanans', LayananController::class)->except(['create', 'edit', 'show']);
    Route::resource('transparansis', TransparansiController::class)->except(['create', 'edit', 'show']);
    Route::resource('beritas', BeritaController::class)->except(['create', 'edit', 'show']);
    Route::resource('potensis', PotensiController::class)->except(['create', 'edit', 'show']);
    Route::resource('sliders', SliderController::class)->except(['show', 'edit', 'create']);
    Route::resource('kegiatan', AdminKegiatanController::class);

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
