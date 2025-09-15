{{-- resources/views/admin/statistics/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Statistik Desa')

@section('content')
    <div class="section-header">
        <h2 class="section-title">Statistik Desa</h2>
        <button class="btn" onclick="openModal('statisticModal')">
            <span>+</span>
            Tambah Statistik
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Label</th>
                    <th>Nilai</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($statistics as $statistic)
                    <tr>
                        <td>{{ $statistic->id }}</td>
                        <td>{{ $statistic->label }}</td>
                        <td>{{ number_format($statistic->value, 0, ',', '.') }}</td>
                        <td>{{ $statistic->created_at->format('d-m-Y') }}</td>
                        <td class="action-buttons">
                            <button class="btn btn-sm btn-secondary" onclick="editStatistic({{ $statistic->id }}, '{{ addslashes($statistic->label) }}', '{{ $statistic->value }}')">
                                Edit
                            </button>
                            <form method="POST" action="{{ route('admin.statistics.destroy', $statistic) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 2rem; color: #64748b;">
                            Belum ada data statistik
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($statistics->hasPages())
        <div class="pagination-container">
            {{ $statistics->links() }}
        </div>
    @endif

    <!-- Add Modal -->
    <div class="modal" id="statisticModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Statistik</h3>
                <button class="close-btn" onclick="closeModal('statisticModal')">&times;</button>
            </div>
            <form method="POST" action="{{ route('admin.statistics.store') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Label</label>
                    <input type="text" name="label" class="form-input @error('label') error @enderror" placeholder="Contoh: Jumlah Penduduk" value="{{ old('label') }}" required>
                    @error('label')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Nilai</label>
                    <input type="number" name="value" id="addValue" class="form-input @error('value') error @enderror" placeholder="Contoh: 1500" value="{{ old('value') }}" min="0" required>
                    @error('value')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('statisticModal')">Batal</button>
                    <button type="submit" class="btn">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal" id="editStatisticModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit Statistik</h3>
                <button class="close-btn" onclick="closeModal('editStatisticModal')">&times;</button>
            </div>
            <form method="POST" id="editStatisticForm">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-label">Label</label>
                    <input type="text" name="label" id="editStatisticLabel" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Nilai</label>
                    <input type="number" name="value" id="editStatisticValue" class="form-input" min="0" required>
                </div>
                <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('editStatisticModal')">Batal</button>
                    <button type="submit" class="btn">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function editStatistic(id, label, value) {
        document.getElementById('editStatisticForm').action = `/admin/statistics/${id}`;
        document.getElementById('editStatisticLabel').value = label;
        document.getElementById('editStatisticValue').value = value;
        openModal('editStatisticModal');
    }

    // Show modal if there are validation errors
    @if($errors->any())
        document.addEventListener('DOMContentLoaded', function() {
            @if(old('_method') === 'PUT')
                openModal('editStatisticModal');
            @else
                openModal('statisticModal');
            @endif
        });
    @endif
</script>
@endpush