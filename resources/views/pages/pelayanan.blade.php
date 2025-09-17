@extends('layouts.app')

@section('title', 'Pelayanan')

@section('content')
<div class="card-header">
    <h3>Daftar Layanan Kelurahan</h3>
</div>
<div class="card-body">
    <div class="services-grid row">
        @forelse($layanans as $pelayanan)
            <div class="col-md-4 mb-3">
                <div class="card service-card h-100">
                    <div class="card-body text-center">
                        <div class="service-icon mb-2">
                            <i class="fas fa-tasks fa-2x"></i>
                        </div>
                        <div class="service-content">
                            <h4>{{ $pelayanan->title }}</h4>
                            <p>{{ $pelayanan->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p>Tidak ada layanan tersedia.</p>
        @endforelse
    </div>
</div>
@endsection
