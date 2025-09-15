{{-- resources/views/admin/budgets/create.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Tambah Anggaran')

@section('content')
    <div class="section-header">
        <h2 class="section-title">Tambah Anggaran Baru</h2>
        <a href="{{ route('admin.budgets.index') }}" class="btn btn-secondary">
            <span>←</span>
            Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="form-container">
        <form method="POST" action="{{ route('admin.budgets.store') }}">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Label Anggaran <span style="color: red;">*</span></label>
                <input type="text" 
                       name="label" 
                       class="form-input @error('label') form-input-error @enderror" 
                       placeholder="Contoh: Pendapatan Desa, Belanja Operasional" 
                       value="{{ old('label') }}" 
                       required>
                @error('label')
                    <span class="form-error">{{ $message }}</span>
                @enderror
                <small class="form-help">Berikan nama yang jelas dan deskriptif untuk anggaran ini</small>
            </div>

            <div class="form-group">
                <label class="form-label">Jumlah Anggaran <span style="color: red;">*</span></label>
                <input type="text" 
                       name="amount" 
                       id="amountInput"
                       class="form-input @error('amount') form-input-error @enderror" 
                       placeholder="Contoh: 2500000" 
                       value="{{ old('amount') }}" 
                       required>
                @error('amount')
                    <span class="form-error">{{ $message }}</span>
                @enderror
                <small class="form-help">Masukkan jumlah dalam angka saja (minimal 0). Contoh: 2500000</small>
            </div>

            <div class="preview-section" id="previewSection" style="display: none;">
                <h4>Preview Anggaran</h4>
                <div class="preview-card">
                    <div class="preview-item">
                        <strong>Label:</strong>
                        <span id="previewLabel">-</span>
                    </div>
                    <div class="preview-item">
                        <strong>Jumlah:</strong>
                        <span id="previewAmount" class="text-success">Rp 0</span>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.budgets.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn">Simpan Anggaran</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const amountInput = document.getElementById('amountInput');
        const labelInput = document.querySelector('input[name="label"]');
        const previewSection = document.getElementById('previewSection');
        const previewLabel = document.getElementById('previewLabel');
        const previewAmount = document.getElementById('previewAmount');

        function formatRupiah(amount) {
            return 'Rp ' + amount.toLocaleString('id-ID');
        }

        function updatePreview() {
            const labelValue = labelInput.value.trim();
            const amountValue = amountInput.value.replace(/[^\d]/g, '');
            
            if (labelValue || amountValue) {
                previewSection.style.display = 'block';
                previewLabel.textContent = labelValue || '-';
                previewAmount.textContent = amountValue ? formatRupiah(parseInt(amountValue)) : 'Rp 0';
            } else {
                previewSection.style.display = 'none';
            }
        }

        // Format amount input (only numbers)
        amountInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^\d]/g, '');
            e.target.value = value;
            updatePreview();
        });

        // Update preview on label change
        labelInput.addEventListener('input', updatePreview);

        // Initial preview update
        updatePreview();
    });
</script>
@endpush