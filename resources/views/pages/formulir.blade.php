@extends('layouts.app')

@section('title', 'Download Formulir')

@section('content')
<div class="card">
    <div class="card-header">
        <i class="fas fa-download"></i>
        <h3>Download Formulir</h3>
    </div>
    <div class="card-body">
        <ul>
            <li><a href="{{ asset('formulir/domisili.pdf') }}" target="_blank">Formulir Surat Domisili</a></li>
            <li><a href="{{ asset('formulir/usaha.pdf') }}" target="_blank">Formulir Surat Usaha</a></li>
            <li><a href="{{ asset('formulir/kk.pdf') }}" target="_blank">Formulir Kartu Keluarga</a></li>
        </ul>
    </div>
</div>
@endsection
