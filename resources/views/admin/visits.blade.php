@extends('admin.layouts.app', ['title' => 'Kunjungan Hari Ini'])

@section('content')
<div class="header-stats">
    <div style="text-align: right;">
        <div style="font-size: 0.9rem; opacity: 0.8;">Kunjungan Hari Ini</div>
        <div style="font-size: 1.5rem; font-weight: bold;">{{ $todayCount }}</div>
    </div>
</div>
@endsection
