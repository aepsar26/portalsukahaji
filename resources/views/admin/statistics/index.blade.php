{{-- resources/views/admin/statistics/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Statistik Kelurahan')

@section('content')
    <div class="section-header">
        <h2 class="section-title">Statistik Desa</h2>
        <button class="btn" onclick="openModal('statisticModal')">
            <span>+</span>
            Tambah Statistik
        </button>
    </div>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul style="margin:0; padding-left:20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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
                                onclick="editStatistic({{ $statistic->id }}, '{{ $statistic->label }}', {{ $statistic->value }})">
                                Edit
                            </button>
                            <form method="POST" action="{{ route('statistics.destroy', $statistic) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" 
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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

    <!-- Modal Tambah Statistik -->
    <div class="modal" id="statisticModal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Statistik</h3>
                <button class="close-btn" onclick="closeModal('statisticModal')">&times;</button>
            </div>
            <form method="POST" action="{{ route('statistics.store') }}">
                @csrf
                <div class="form-group">
                    <label for="label">Label</label>
                    <input type="text" id="label" name="label" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="value">Value</label>
                    <input type="number" id="value" name="value" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal('statisticModal')">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Statistik -->
    <div class="modal" id="editStatisticModal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit Statistik</h3>
                <button class="close-btn" onclick="closeModal('editStatisticModal')">&times;</button>
            </div>
            <form id="editStatisticForm" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="editLabel">Label</label>
                    <input type="text" id="editLabel" name="label" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="editValue">Value</label>
                    <input type="number" id="editValue" name="value" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal('editStatisticModal')">Batal</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function editStatistic(id, label, value) {
        document.getElementById('editStatisticForm').action = `/statistics/${id}`;
        document.getElementById('editLabel').value = label;
        document.getElementById('editValue').value = value;
        openModal('editStatisticModal');
    }

    function openModal(id) {
        document.getElementById(id).style.display = 'block';
    }

    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }
</script>
@endpush
