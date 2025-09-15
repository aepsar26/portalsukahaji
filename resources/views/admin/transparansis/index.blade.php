@extends('admin.layouts.app')

@section('title', 'Transparansi Dana')

@section('content')
    <div class="section-header">
        <h2 class="section-title">Transparansi Dana</h2>
        <button class="btn" onclick="openModal('transparansiModal')">
            <span>+</span> Tambah Data
        </button>
    </div>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tabel Transparansi --}}
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Jenis</th>
                    <th>Jumlah</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transparansis as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->type }}</td>
                        <td>Rp {{ number_format($item->amount, 2, ',', '.') }}</td>
                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                        <td>
                            <button class="btn btn-sm btn-secondary"
                                onclick="editTransparansi({{ $item->id }}, '{{ addslashes($item->type) }}', '{{ $item->amount }}')">
                                Edit
                            </button>
                            <form method="POST" action="{{ route('admin.transparansis.destroy', $item) }}" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center; padding:2rem; color:#64748b;">
                            Belum ada data transparansi
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah Transparansi -->
    <div class="modal" id="transparansiModal" style="display:none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Tambah Data Transparansi</h3>
                <button class="close-btn" onclick="closeModal('transparansiModal')">&times;</button>
            </div>
            <form method="POST" action="{{ route('admin.transparansis.store') }}">
                @csrf
                <div class="form-group">
                    <label>Jenis</label>
                    <input type="text" name="type" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" step="0.01" name="amount" class="form-input" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('transparansiModal')">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Transparansi -->
    <div class="modal" id="editTransparansiModal" style="display:none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit Data Transparansi</h3>
                <button class="close-btn" onclick="closeModal('editTransparansiModal')">&times;</button>
            </div>
            <form method="POST" id="editTransparansiForm">
                @csrf @method('PUT')
                <div class="form-group">
                    <label>Jenis</label>
                    <input type="text" id="editType" name="type" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" step="0.01" id="editAmount" name="amount" class="form-input" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('editTransparansiModal')">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function editTransparansi(id, type, amount) {
        document.getElementById('editTransparansiForm').action = `/admin/transparansis/${id}`;
        document.getElementById('editType').value = type;
        document.getElementById('editAmount').value = amount;
        openModal('editTransparansiModal');
    }

    function openModal(id) {
        document.getElementById(id).style.display = 'flex';
    }

    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }
</script>
@endpush
