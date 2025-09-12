<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('index');
});

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
