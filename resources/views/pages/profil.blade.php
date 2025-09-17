@extends('layouts.app')

@section('title', 'Profil')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>{{ $profil->title ?? 'Profil Kelurahan' }}</h3>
    </div>
    <div class="card-body">
        <p>{{ $profil->content ?? 'Belum ada data' }}</p>
    </div>
</div>
@endsection
