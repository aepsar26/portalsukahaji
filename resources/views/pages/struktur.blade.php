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
                <img src="{{ asset('storage/'.$kepala->photo) }}" alt="{{ $kepala->name }}">
                <span class="jabatan">{{ $kepala->position }}</span><br>
                <strong class="nama">{{ $kepala->name }}</strong><br>
                <div class="nip-field"><strong>NIP:</strong> {{ $kepala->nip }}</div>
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
                <img src="{{ asset('storage/'.$sekretaris->photo) }}" alt="{{ $sekretaris->name }}">
                <span class="jabatan">{{ $sekretaris->position }}</span><br>
                <strong class="nama">{{ $sekretaris->name }}</strong><br>
                <div class="nip-field"><strong>NIP:</strong> {{ $sekretaris->nip }}</div>
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
                    <img src="{{ asset('storage/'.$seksi->photo) }}" alt="{{ $seksi->name }}">
                    <span class="jabatan">{{ $seksi->position }}</span><br>
                    <strong class="nama">{{ $seksi->name }}</strong><br>
                    <div class="nip-field"><strong>NIP:</strong> {{ $seksi->nip }}</div>
                </div>
            @endforeach
        </div>
    @endif
</div>


</div>
@endsection
