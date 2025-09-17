@extends('layouts.app')

@section('title', 'Beranda - Kelurahan Sukahaji')

@section('content')
<section class="hero">
    <div class="bg-slider">
        @foreach($sliders as $index => $slider)
            <div class="slide" 
                 style="background-image: url('{{ asset('storage/'.$slider->image) }}'); 
                        animation-delay: {{ $index * 5 }}s;">
            </div>
        @endforeach
    </div>
    <div class="hero-content">
        <h2>Selamat Datang di Website Resmi Kelurahan Sukahaji</h2>
        <p>Website profil dan data digital pembangunan yang mudah diakses dengan transparansi terukur.</p>
    </div>
</section>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <div class="content-grid">
                <div class="main-column">
                    <!-- Data Kependudukan -->
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-users"></i>
                            <h3>Data Kependudukan</h3>
                        </div>
                        <div class="card-body">
                            <p class="desc">
                                Sistem digital yang berfungsi mempermudah pengelolaan data dan informasi terkait dengan kependudukan.
                            </p>
                            <br>
                            <div class="stats-grid">
                                @foreach($statistics as $stat)
                                    <div class="stat-card">
                                        <span class="stat-number" data-count="{{ $stat->value }}">0</span>
                                        <div class="stat-label">{{ $stat->label }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Transparansi Anggaran -->
                   <div class="card mt-30">
                        <div class="card-header">
                            <i class="fas fa-chart-pie"></i>
                            <h3>Transparansi Anggaran</h3>
                        </div>
                        <div class="card-body">
                            <p class="desc">
                                Akses cepat dan transparan terhadap Anggaran Kelurahan serta proyek pembangunan
                            </p>
                            <div class="budget-grid">
                                @foreach($budgets as $budget)
                                    <div class="budget-item">
                                        <div class="budget-amount">Rp {{ number_format($budget->amount, 0, ',', '.') }}</div>
                                        <div class="budget-label">{{ $budget->label }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                    


                <div class="sidebar">
                <!-- Kepala Kelurahan -->
                    @if(isset($kepala) && $kepala)
                        <div class="kepala-kelurahan-card">
                            <div class="kepala-photo">
                                @if($kepala->photo && file_exists(public_path('storage/' . $kepala->photo)))
                                    <img src="{{ asset('storage/' . $kepala->photo) }}" 
                                        alt="{{ $kepala->name }}" 
                                        class="foto-kepala"
                                        style="object-fit: cover; border-radius: 50%; background: transparent;" />
                                @else
                                    <img src="{{ asset('images/default-profile.png') }}" 
                                        alt="Default Photo" 
                                        class="foto-kepala"
                                        style="object-fit: cover; border-radius: 50%; background: transparent;" />
                                @endif
                            </div>
                            <div class="kepala-info">
                                <div class="jabatan">{{ $kepala->position }}</div> {{-- ✅ Jabatan di atas --}}
                                <h3 class="nama">{{ $kepala->name }}</h3> {{-- ✅ tambahkan class "nama" --}}
                                <br>
                                <div class="nip-field">
                                    <strong>NIP:</strong> {{ $kepala->nip }}
                                </div>
                                <p>{{ $kepala->description }}</p>
                            </div>
                        </div>
                    @else
                        <p style="color:#64748b;">Belum ada data Kepala Kelurahan.</p>
                    @endif


                    <!-- Quick Access -->
                    <div class="quick-access">
                        <h3><i class="fas fa-rocket"></i> Akses Cepat</h3>
                        <ul class="quick-links">
                            <li><a href="{{ route('peta') }}"><i class="fas fa-map-marker-alt"></i> Peta Kelurahan</a></li>
                            <li><a href="{{ route('struktur') }}"><i class="fas fa-sitemap"></i> Struktur Organisasi</a></li>
                            <li><a href="{{ route('persuratan') }}"><i class="fas fa-file-alt"></i> Persuratan Online</a></li>
                            <li><a href="{{ route('agenda') }}"><i class="fas fa-calendar-alt"></i> Agenda Kegiatan</a></li>
                            <li><a href="{{ route('pengaduan') }}"><i class="fas fa-phone"></i> Pengaduan Online</a></li>
                            <li><a href="{{ route('formulir') }}"><i class="fas fa-download"></i> Download Formulir</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Services Grid -->
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <div class="service-content">
                        <h4>Berita Terkini</h4>
                        <p>Menyajikan informasi terbaru tentang peristiwa, berita terkini, dan artikel-artikel jurnalistik dari Kelurahan Sukahaji</p>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <div class="service-content">
                        <h4>Potensi Kelurahan</h4>
                        <p>Informasi tentang potensi dan kemajuan Kelurahan di berbagai bidang seperti ekonomi, pariwisata, pertanian, industri kreatif, dan kelestarian lingkungan</p>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-camera"></i>
                    </div>
                    <div class="service-content">
                        <h4>Wisata Kelurahan</h4>
                        <p>Layanan yang mempermudah promosi wisata Kelurahan sehingga dapat menarik pengunjung dan wisatawan</p>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-store"></i>
                    </div>
                    <div class="service-content">
                        <h4>UMKM Kelurahan</h4>
                        <p>Layanan yang disediakan promosi produk UMKM Kelurahan sehingga mampu meningkatkan perekonomian masyarakat</p>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="service-content">
                        <h4>Pelayanan Administrasi</h4>
                        <p>Sistem pelayanan administrasi kependudukan yang efisien dan transparan</p>
                        <ul class="service-list">
                            <li><i class="fas fa-check"></i> Kartu Tanda Penduduk (KTP)</li>
                            <li><i class="fas fa-check"></i> Kartu Keluarga (KK)</li>
                            <li><i class="fas fa-check"></i> Akta Kelahiran</li>
                            <li><i class="fas fa-check"></i> Surat Keterangan Domisili</li>
                            <li><i class="fas fa-check"></i> Surat Keterangan Tidak Mampu</li>
                        </ul>
                    </div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="service-content">
                        <h4>Kegiatan Kelurahan</h4>
                        <p>Menampilkan kegiatan-kegiatan yang berlangsung di Kelurahan Sukahaji</p>
                        <ul class="service-list">
                            <li><i class="fas fa-check"></i> Program Kampung Hijau</li>
                            <li><i class="fas fa-check"></i> Kelurahan Smart City</li>
                            <li><i class="fas fa-check"></i> Senam Sehat Bersama</li>
                            <li><i class="fas fa-check"></i> Bank Sampah</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
