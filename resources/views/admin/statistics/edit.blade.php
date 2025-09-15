{{-- resources/views/admin/statistics/edit.blade.php --}}
@extends('admin.layouts.app', ['title' => 'Edit Statistik'])

@section('content')
<div class="form-container">
    <h3>Edit Statistik</h3>
    
    <form action="{{ route('admin.statistics.update', $statistic) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label class="form-label">Label</label>
            <input type="text" 
                   class="form-input @error('label') error @enderror" 
                   name="label" 
                   value="{{ old('label', $statistic->label) }}" 
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
                   value="{{ old('value', $statistic->value) }}" 
                   placeholder="Masukkan nilai"
                   min="0"
                   required>
            @error('value')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
        <div style="display: flex; gap: 1rem; justify-content: flex-end;">
            <a href="{{ route('admin.statistics.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn">Update</button>
        </div>
    </form>
</div>
@endsection