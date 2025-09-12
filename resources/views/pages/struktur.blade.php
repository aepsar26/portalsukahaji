@extends('layouts.app')

@section('title', 'Struktur Organisasi')

@section('content')
<div class="card">
    <div class="card-header">
        <i class="fas fa-sitemap"></i>
        <h3>Struktur Organisasi</h3>
    </div>
    <div class="card-body">
        <p>Struktur organisasi Kelurahan Sukahaji:</p>
        <img src="{{ asset('images/struktur.png') }}" alt="Struktur Organisasi" style="max-width:100%;">
    </div>
</div>
@endsection
