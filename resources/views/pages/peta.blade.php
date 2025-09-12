@extends('layouts.app')

@section('title', 'Peta Kelurahan')

@section('content')
<div class="card">
    <div class="card-header">
        <i class="fas fa-map-marker-alt"></i>
        <h3>Peta Kelurahan</h3>
    </div>
    <div class="card-body">
        <p>Berikut adalah peta wilayah Kelurahan Sukahaji:</p>
        <iframe src="https://www.google.com/maps/embed?..." width="100%" height="400" style="border:0;" allowfullscreen=""></iframe>
    </div>
</div>
@endsection
