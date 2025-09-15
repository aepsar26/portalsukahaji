{{-- resources/views/admin/statistics/create.blade.php --}}
@extends('admin.layouts.app', ['title' => 'Tambah Statistik'])

@section('content')
<div class="form-container">
    <h3>Tambah Statistik Baru</h3>
    
    <form action="{{ route('admin.statistics.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label">Label</label>
            <input type="text" 
                   class="form-input @error('label') error @enderror" 
                   name="label" 
                   value="{{ old('label') }}" 
                   placeholder="Contoh: Total Penduduk"
                   required>
            @error('label')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label class="form-label">Value</label>
            <input type="number" 
                   class="form-input @error('value') error @enderror" 
                   name="value" 
                   value="{{ old('value') }}" 
                   placeholder="Masukkan nilai"
                   min="0"
                   required>
            @error('value')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
        <div style="display: flex; gap: 1rem; justify-content: flex-end;">
            <a href="{{ route('admin.statistics.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn">Simpan</button>
        </div>
    </form>
</div>
@endsection