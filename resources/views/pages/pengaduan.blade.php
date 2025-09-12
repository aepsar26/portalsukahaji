@extends('layouts.app')

@section('title', 'Pengaduan Online')

@section('content')
<div class="card">
    <div class="card-header">
        <i class="fas fa-phone"></i>
        <h3>Pengaduan Online</h3>
    </div>
    <div class="card-body">
        <form>
            <label>Nama</label>
            <input type="text" class="form-control mb-2">

            <label>Jenis Pengaduan</label>
            <select class="form-control mb-2">
                <option>Infrastruktur</option>
                <option>Pelayanan Publik</option>
                <option>Lainnya</option>
            </select>

            <label>Deskripsi Pengaduan</label>
            <textarea class="form-control mb-2"></textarea>

            <button class="btn btn-danger">Kirim</button>
        </form>
    </div>
</div>
@endsection
