@extends('admin.layouts.app')

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <h3>Total Statistik</h3>
        <div class="stat-value">{{ $stats['total_statistics'] }}</div>
        <div class="stat-change">+12% dari bulan lalu</div>
    </div>
    <div class="stat-card">
        <h3>Anggaran Aktif</h3>
        <div class="stat-value">{{ $stats['active_budgets'] }}</div>
        <div class="stat-change">2 baru ditambahkan</div>
    </div>
    <div class="stat-card">
        <h3>Berita Published</h3>
        <div class="stat-value">{{ $stats['published_news'] }}</div>
        <div class="stat-change">+5 minggu ini</div>
    </div>
    <div class="stat-card">
        <h3>Layanan Tersedia</h3>
        <div class="stat-value">{{ $stats['available_services'] }}</div>
        <div class="stat-change">Semua aktif</div>
    </div>
</div>

<div class="form-container">
    <h3>Selamat Datang di Panel Admin</h3>
    <p>Gunakan menu di sebelah kiri untuk mengelola data Kelurahan. Sistem ini memungkinkan Anda untuk:</p>
    <ul style="margin: 1rem 0; padding-left: 2rem;">
        <li>Mengelola data statistik kependudukan</li>
        <li>Mengatur anggaran dan transparansi keuangan</li>
        <li>Memperbarui profil dan informasi Kelurahan</li>
        <li>Mengelola data pemerintahan Kelurahan</li>
        <li>Mengatur layanan yang tersedia</li>
        <li>Mempublish berita dan informasi terkini</li>
        <li>Menampilkan potensi Kelurahan</li>
    </ul>
</div>
@endsection