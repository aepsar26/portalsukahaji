@extends('layouts.app')

@section('title', 'Pelayanan')

@section('content')
<div class="card-header">
    <h3>Daftar Layanan Kelurahan</h3>
</div>
<div class="card-body">
    <div class="services-grid">
        @forelse($layanans as $pelayanan)
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-tasks"></i>
                </div>
                <div class="service-content">
                    <h4>{{ $pelayanan->judul }}</h4>
                    <p>{{ $pelayanan->deskripsi }}</p>
                </div>
            </div>
        @empty
            <p>Tidak ada layanan tersedia.</p>
        @endforelse
    </div>
</div>

@endsection
