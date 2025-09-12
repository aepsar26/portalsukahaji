@extends('layouts.app')

@section('title', 'Berita')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Berita Terkini</h3>
    </div>
    <div class="card-body">
        @forelse($beritas as $berita)
            <div class="service-card" style="margin-bottom:20px;">
                <div class="service-icon">
                    <i class="fas fa-newspaper"></i>
                </div>
                <div class="service-content">
                    <h4>{{ $berita->judul }}</h4>
                    <small class="text-muted">{{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}</small>
                    <p>{{ $berita->konten }}</p>
                </div>
            </div>
        @empty
            <p>Belum ada berita.</p>
        @endforelse
    </div>
</div>
@endsection
