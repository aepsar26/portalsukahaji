@extends('layouts.app')

@section('title', 'Pemerintahan')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Struktur Pemerintahan</h3>
    </div>
    <div class="card-body">
        <ul>
            @forelse($pemerintahan as $p)
                <li><strong>{{ $p->nama }}</strong> - {{ $p->jabatan }}</li>
            @empty
                <li>Belum ada data</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
