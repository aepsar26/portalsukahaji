@extends('layouts.app')

@section('title', 'Berita')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Berita Terkini</h3>
    </div>
    <div class="card-body">
        @forelse($beritas as $berita)
            <div class="service-card mb-4 p-3 border rounded shadow-sm">
                <div class="service-icon mb-2">
                    <i class="fas fa-newspaper fa-lg"></i>
                </div>
                <div class="service-content">
                    <h4>{{ $berita->title }}</h4>
                    <small class="text-muted">
                        {{ \Carbon\Carbon::parse($berita->date)->translatedFormat('d F Y') }}
                    </small>
                    <p class="mt-2">{{ $berita->content }}</p>

                    @if($berita->image)
                        <img src="{{ asset('storage/' . $berita->image) }}" 
                             alt="{{ $berita->title }}" 
                             class="img-fluid mt-2 rounded">
                    @endif
                </div>
            </div>
        @empty
            <p>Belum ada berita.</p>
        @endforelse
    </div>
</div>
@endsection
