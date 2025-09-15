{{-- resources/views/admin/statistics/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Statistik Kelurahan')

@section('content')
    <div class="section-header">
        <h2 class="section-title">Statistik Desa</h2>
        <button class="btn" onclick="openModal('statisticModal')">
            <span>+</span> Tambah Statistik
        </button>
    </div>

    {{-- Tabel Statistik --}}
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Label</th>
                    <th>Value</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($statistics as $statistic)
                    <tr>
                        <td>{{ $statistic->id }}</td>
                        <td>{{ $statistic->label }}</td>
                        <td>{{ number_format($statistic->value) }}</td>
                        <td>{{ $statistic->created_at->format('d-m-Y') }}</td>
                        <td class="action-buttons">
                            <button class="btn btn-sm btn-secondary" 
                                onclick="editStatistic({{ $statistic->id }}, '{{ addslashes($statistic->label) }}', {{ $statistic->value }})">
                                Edit
                            </button>
                            <form id="delete-form-{{ $statistic->id }}" method="POST" 
                                  action="{{ route('admin.statistics.destroy', $statistic) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger" 
                                    onclick="confirmDelete('delete-form-{{ $statistic->id }}')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center; padding:2rem; color:#64748b;">
                            Belum ada data statistik
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah Statistik -->
    <div class="modal" id="statisticModal" style="display:none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Tambah Statistik</h3>
                <button class="close-btn" onclick="closeModal('statisticModal')">&times;</button>
            </div>
            <form method="POST" action="{{ route('admin.statistics.store') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="label">Label</label>
                    <input type="text" id="label" name="label" 
                        class="form-input @error('label') error @enderror" 
                        value="{{ old('label') }}" required>
                    @error('label')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="value">Value</label>
                    <input type="number" id="value" name="value" 
                        class="form-input @error('value') error @enderror" 
                        value="{{ old('value') }}" required>
                    @error('value')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('statisticModal')">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Statistik -->
    <div class="modal" id="editStatisticModal" style="display:none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit Statistik</h3>
                <button class="close-btn" onclick="closeModal('editStatisticModal')">&times;</button>
            </div>
            <form id="editStatisticForm" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-label" for="editLabel">Label</label>
                    <input type="text" id="editLabel" name="label" 
                        class="form-input @error('label') error @enderror" required>
                    @error('label')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="editValue">Value</label>
                    <input type="number" id="editValue" name="value" 
                        class="form-input @error('value') error @enderror" required>
                    @error('value')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('editStatisticModal')">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function editStatistic(id, label, value) {
        document.getElementById('editStatisticForm').action = `/admin/statistics/${id}`;
        document.getElementById('editLabel').value = label;
        document.getElementById('editValue').value = value;
        openModal('editStatisticModal');
    }

    function openModal(id) {
        document.getElementById(id).style.display = 'flex';
    }

    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }
</script>
@endpush
