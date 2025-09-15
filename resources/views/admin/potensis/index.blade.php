@extends('admin.layouts.app')

@section('title', 'Potensi Desa')

@section('content')
    <div class="section-header">
        <h2 class="section-title">Potensi Desa</h2>
        <button class="btn" onclick="openModal('potensiModal')">
            <span>+</span> Tambah Potensi
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
                    <th>Gambar</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($potensis as $potensi)
                    <tr>
                        <td>{{ $potensi->id }}</td>
                        <td>{{ $potensi->title }}</td>
                        <td style="max-width:300px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                            {{ $potensi->description }}
                        </td>
                        <td>
                            @if($potensi->image)
                                <img src="{{ asset('storage/' . $potensi->image) }}" alt="" width="80">
                            @else
                                <span style="color:#94a3b8;">Tidak ada</span>
                            @endif
                        </td>
                        <td>{{ $potensi->created_at->format('d-m-Y') }}</td>
                        <td>
                            <button class="btn btn-sm btn-secondary"
                                onclick="editPotensi({{ $potensi->id }}, '{{ addslashes($potensi->title) }}', '{{ addslashes($potensi->description) }}')">
                                Edit
                            </button>
                            <form action="{{ route('admin.potensis.destroy', $potensi) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center; padding:1rem; color:#94a3b8;">Belum ada data potensi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah Potensi -->
    <div class="modal" id="potensiModal" style="display:none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Tambah Potensi</h3>
                <button class="close-btn" onclick="closeModal('potensiModal')">&times;</button>
            </div>
            <form method="POST" action="{{ route('admin.potensis.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" name="title" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="description" class="form-input" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label>Gambar (Opsional)</label>
                    <input type="file" name="image" class="form-input">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('potensiModal')">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Potensi -->
    <div class="modal" id="editPotensiModal" style="display:none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit Potensi</h3>
                <button class="close-btn" onclick="closeModal('editPotensiModal')">&times;</button>
            </div>
            <form method="POST" id="editPotensiForm" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" id="editTitle" name="title" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea id="editDescription" name="description" class="form-input" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label>Gambar (Opsional)</label>
                    <input type="file" name="image" class="form-input">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('editPotensiModal')">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function editPotensi(id, title, description) {
        document.getElementById('editPotensiForm').action = `/admin/potensis/${id}`;
        document.getElementById('editTitle').value = title;
        document.getElementById('editDescription').value = description;
        openModal('editPotensiModal');
    }

    function openModal(id) {
        document.getElementById(id).style.display = 'flex';
    }

    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }
</script>
@endpush
