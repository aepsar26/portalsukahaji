@extends('layouts.app')

@section('title', 'Persuratan Online')

@section('content')
<div class="card">
    <div class="card-header">
        <i class="fas fa-file-alt"></i>
        <h3>Persuratan Online</h3>
    </div>
    <div class="card-body">
        <p>Silakan ajukan surat online melalui form berikut:</p>
        <form>
            <label>Nama Lengkap</label>
            <input type="text" class="form-control mb-2">
            
            <label>Jenis Surat</label>
            <select class="form-control mb-2">
                <option>Surat Keterangan Domisili</option>
                <option>Surat Keterangan Usaha</option>
                <option>Surat Pengantar RT/RW</option>
            </select>
            
            <label>Keterangan</label>
            <textarea class="form-control mb-2"></textarea>
            
            <button class="btn btn-primary">Kirim</button>
        </form>
    </div>
</div>
@endsection
