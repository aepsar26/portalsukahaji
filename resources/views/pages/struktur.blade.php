@extends('layouts.app')

@section('title', 'Struktur Organisasi')

@section('content')
<div class="card">
    <div class="card-header text-center">
        <i class="fas fa-sitemap"></i>
        <h3>Struktur Organisasi</h3>
        </div>
<div class="org-chart">

    {{-- Kepala Kelurahan --}}
    @if($kepala)
        <div class="org-level top">
            <div class="org-item">
                <div class="card-content">
                    <img src="{{ asset('storage/'.$kepala->photo) }}" alt="{{ $kepala->name }}">
                    <div class="info">
                        <span class="jabatan">{{ $kepala->position }}</span><br>
                        <u><strong class="nama">{{ $kepala->name }}</strong></u><br>
                        <div class="nip-field"><strong>NIP:</strong> {{ $kepala->nip }}</div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Garis turun dari Kepala --}}
    <div class="org-connector vertical"></div>

    {{-- Sekretaris di kanan garis --}}
    @if($sekretaris)
        <div class="sekretaris-wrapper">
            <div class="vertical-line"></div>
            <div class="horizontal-line"></div>
            <div class="org-item sekretaris">
                <div class="card-content">
                    <img src="{{ asset('storage/'.$sekretaris->photo) }}" alt="{{ $sekretaris->name }}">
                    <div class="info">
                        <span class="jabatan">{{ $sekretaris->position }}</span><br>
                        <u><strong class="nama">{{ $sekretaris->name }}</strong></u><br>
                        <div class="nip-field"><strong>NIP:</strong> {{ $sekretaris->nip }}</div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Garis turun ke Kepala Seksi --}}
    <div class="org-connector vertical"></div>

    {{-- Kepala Seksi --}}
    @if($kepalaSeksi->count())
        <div class="org-level horizontal">
            @foreach($kepalaSeksi as $seksi)
                <div class="org-item">
                    <div class="card-content">
                        <img src="{{ asset('storage/'.$seksi->photo) }}" alt="{{ $seksi->name }}">
                        <div class="info">
                            <span class="jabatan">{{ $seksi->position }}</span><br>
                            <u><strong class="nama">{{ $seksi->name }}</strong></u><br>
                            <div class="nip-field"><strong>NIP:</strong> {{ $seksi->nip }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>


</div>
@endsection
