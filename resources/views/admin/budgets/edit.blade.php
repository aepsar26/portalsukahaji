{{-- resources/views/admin/budgets/edit.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Edit Anggaran')

@section('content')
    <div class="section-header">
        <h2 class="section-title">Edit Anggaran</h2>
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

    <div class="info-banner">
        <strong>Info:</strong> Anda sedang mengedit anggaran "<strong>{{ $budget->label }}</strong>"
    </div>

    <div class="form-container">
        <form method="POST" action="{{ route('admin.budgets.update', $budget) }}">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label class="form-label">Label Anggaran <span style="color: red;">*</span></label>
                <input type="text" 
                       name="label" 
                       class="form-input @error('label') form-input-error @enderror" 
                       placeholder="Contoh: Pendapatan Desa" 
                       value="{{ old('label', $budget->label) }}" 
                       required>
                @error('label')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Jumlah Anggaran <span style="color: red;">*</span></label>
                <input type="text" 
                       name="amount" 
                       id="amountInput"
                       class="form-input @error('amount') form-input-error @enderror" 
                       placeholder="Contoh: 2500000" 
                       value="{{ old('amount', $budget->amount) }}" 
                       required>
                @error('amount')
                    <span class="form-error">{{ $message }}</span>
                @enderror
                <small class="form-help">Masukkan jumlah dalam angka saja (minimal 0)</small>
            </div>

            <div class="comparison-section">
                <h4>Perbandingan</h4>
                <div class="comparison-grid">
                    <div class="comparison-item">
                        <label><strong>Nilai Sebelumnya:</strong></label>
                        <span class="text-muted">Rp {{ number_format($budget->amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="comparison-item">
                        <label><strong>Nilai Baru:</strong></label>
                        <span id="previewAmount" class="text-success">Rp {{ number_format($budget->amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="comparison-item">
                        <label><strong>Selisih:</strong></label>
                        <span id="differenceAmount" class="text-muted">Rp 0</span>
                    </div>
                </div>
            </div>

            <div class="timestamp-section">
                <div class="timestamp-grid">
                    <div class="timestamp-item">
                        <div class="timestamp-card">
                            <h5>Dibuat pada</h5>
                            <p>{{ $budget->created_at->format('d/m/Y H:i:s') }}</p>
                        </div>
                    </div>
                    <div class="timestamp-item">
                        <div class="timestamp-card">
                            <h5>Terakhir diubah</h5>
                            <p>{{ $budget->updated_at->format('d/m/Y H:i:s') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.budgets.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn">Update Anggaran</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const amountInput = document.getElementById('amountInput');
        const previewAmount = document.getElementById('previewAmount');
        const differenceAmount = document.getElementById('differenceAmount');
        const originalAmount = {{ $budget->amount }};

        function formatRupiah(amount) {
            return 'Rp ' + amount.toLocaleString('id-ID');
        }

        function updateComparison() {
            const currentAmount = parseInt(amountInput.value) || 0;
            const difference = currentAmount - originalAmount;
            
            previewAmount.textContent = formatRupiah(currentAmount);
            
            if (difference > 0) {
                differenceAmount.textContent = '+' + formatRupiah(difference);
                differenceAmount.className = 'text-success';
            } else if (difference < 0) {
                differenceAmount.textContent = formatRupiah(difference);
                differenceAmount.className = 'text-danger';
            } else {
                differenceAmount.textContent = 'Rp 0';
                differenceAmount.className = 'text-muted';
            }
        }

        // Format amount input (only numbers)
        amountInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^\d]/g, '');
            e.target.value = value;
            updateComparison();
        });

        // Initial comparison update
        updateComparison();
    });
</script>
@endpush