{{-- resources/views/admin/beritas/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Berita')

@section('content')
    <div class="section-header">
        <h2 class="section-title">Berita</h2>
        <button class="btn" onclick="openModal('beritaModal')">
            <span>+</span>
            Tambah Berita
        </button>
    </div>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Konten</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($beritas as $berita)
                    <tr>
                        <td>{{ $berita->id }}</td>
                        <td>{{ $berita->judul }}</td>
                        <td class="truncate">{{ Str::limit($berita->konten, 50) }}</td>
                        <td>{{ $berita->tanggal->format('d-m-Y') }}</td>
                        <td class="action-buttons">
                            <button class="btn btn-sm btn-secondary" onclick="editBerita({{ $berita->id }}, '{{ addslashes($berita->judul) }}', '{{ addslashes($berita->konten) }}', '{{ $berita->tanggal->format('Y-m-d') }}')">
                                Edit
                            </button>
                            <form method="POST" action="{{ route('admin.beritas.destroy', $berita) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 2rem; color: #64748b;">
                            Belum ada berita
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Add Modal -->
    <div class="modal" id="beritaModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Berita</h3>
                <button class="close-btn" onclick="closeModal('beritaModal')">&times;</button>
            </div>
            <form method="POST" action="{{ route('admin.beritas.store') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Judul Berita</label>
                    <input type="text" name="judul" class="form-input" placeholder="Judul berita yang menarik" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Konten</label>
                    <textarea name="konten" class="form-input form-textarea" placeholder="Isi konten berita..." required></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-input" value="{{ date('Y-m-d') }}" required>
                </div>
                <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('beritaModal')">Batal</button>
                    <button type="submit" class="btn">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal" id="editBeritaModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit Berita</h3>
                <button class="close-btn" onclick="closeModal('editBeritaModal')">&times;</button>
            </div>
            <form method="POST" id="editBeritaForm">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-label">Judul Berita</label>
                    <input type="text" name="judul" id="editBeritaJudul" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Konten</label>
                    <textarea name="konten" id="editBeritaKonten" class="form-input form-textarea" required></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" id="editBeritaTanggal" class="form-input" required>
                </div>
                <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('editBeritaModal')">Batal</button>
                    <button type="submit" class="btn">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function editBerita(id, judul, konten, tanggal) {
        document.getElementById('editBeritaForm').action = `/admin/beritas/${id}`;
        document.getElementById('editBeritaJudul').value = judul;
        document.getElementById('editBeritaKonten').value = konten;
        document.getElementById('editBeritaTanggal').value = tanggal;
        openModal('editBeritaModal');
    }
</script>
@endpush