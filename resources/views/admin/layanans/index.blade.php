@extends('admin.layouts.app')

@section('title', 'Layanan')

@section('content')
    <div class="section-header">
        <h2 class="section-title">Layanan</h2>
        <button class="btn" onclick="openModal('layananModal')">
            <span>+</span> Tambah Layanan
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($layanans as $layanan)
                    <tr>
                        <td>{{ $layanan->id }}</td>
                        <td>{{ $layanan->title }}</td>
                        <td style="max-width:350px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                            {{ $layanan->description }}
                        </td>
                        <td>{{ $layanan->created_at->format('d-m-Y') }}</td>
                        <td>
                            <button class="btn btn-sm btn-secondary"
                                onclick="editLayanan({{ $layanan->id }}, '{{ addslashes($layanan->title) }}', '{{ addslashes($layanan->description) }}')">
                                Edit
                            </button>
                            <form method="POST" action="{{ route('admin.layanans.destroy', $layanan) }}" style="display:inline;">
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
                            Belum ada data layanan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah -->
    <div class="modal" id="layananModal" style="display:none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Tambah Layanan</h3>
                <button class="close-btn" onclick="closeModal('layananModal')">&times;</button>
            </div>
            <form method="POST" action="{{ route('admin.layanans.store') }}">
                @csrf
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" name="title" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="description" class="form-input" rows="5" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('layananModal')">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal" id="editLayananModal" style="display:none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit Layanan</h3>
                <button class="close-btn" onclick="closeModal('editLayananModal')">&times;</button>
            </div>
            <form method="POST" id="editLayananForm">
                @csrf @method('PUT')
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" id="editTitle" name="title" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea id="editDescription" name="description" class="form-input" rows="5" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('editLayananModal')">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function editLayanan(id, title, description) {
        document.getElementById('editLayananForm').action = `/admin/layanans/${id}`;
        document.getElementById('editTitle').value = title;
        document.getElementById('editDescription').value = description;
        openModal('editLayananModal');
    }

    function openModal(id) {
        document.getElementById(id).style.display = 'flex';
    }

    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }
</script>
@endpush
