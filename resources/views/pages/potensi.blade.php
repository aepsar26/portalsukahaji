@extends('layouts.app')

@section('title', 'Potensi')

@section('content')
<div class="card-header">
    <h3>Potensi Kelurahan</h3>
</div>
<div class="card-body">
    <div class="services-grid">
        @forelse ($potensis as $potensi)
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-seedling"></i>
                </div>
                <h4>{{ $potensi->nama }}</h4>
                <p>{{ $potensi->deskripsi }}</p>
            </div>
        @empty
            <p>Belum ada data potensi.</p>
        @endforelse
    </div>
</div>

@endsection
