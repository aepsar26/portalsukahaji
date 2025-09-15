@extends('admin.layouts.app')

@section('title', 'Profil Desa')

@section('content')
    <div class="section-header">
        <h2 class="section-title">Profil Desa</h2>
        <button class="btn" onclick="openModal('profilModal')">
            <span>+</span> Tambah Profil
        </button>
    </div>

    {{-- Alert Sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tabel Profil --}}
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Konten</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($profils as $profil)
                    <tr>
                        <td>{{ $profil->id }}</td>
                        <td>{{ $profil->title }}</td>
                        <td style="max-width:350px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                            {{ $profil->content }}
                        </td>
                        <td>{{ $profil->created_at->format('d-m-Y') }}</td>
                        <td>
                            <button class="btn btn-sm btn-secondary"
                                onclick="editProfil({{ $profil->id }}, '{{ addslashes($profil->title) }}', '{{ addslashes($profil->content) }}')">
                                Edit
                            </button>
                            <form action="{{ route('admin.profils.destroy', $profil) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center; padding:1rem;">Belum ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah -->
    <div class="modal" id="profilModal" style="display:none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Tambah Profil</h3>
                <button class="close-btn" onclick="closeModal('profilModal')">&times;</button>
            </div>
            <form method="POST" action="{{ route('admin.profils.store') }}">
                @csrf
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" name="title" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Konten</label>
                    <textarea name="content" class="form-input" rows="5" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('profilModal')">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal" id="editProfilModal" style="display:none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit Profil</h3>
                <button class="close-btn" onclick="closeModal('editProfilModal')">&times;</button>
            </div>
            <form method="POST" id="editProfilForm">
                @csrf @method('PUT')
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" id="editTitle" name="title" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Konten</label>
                    <textarea id="editContent" name="content" class="form-input" rows="5" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('editProfilModal')">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function editProfil(id, title, content) {
        document.getElementById('editProfilForm').action = `/admin/profils/${id}`;
        document.getElementById('editTitle').value = title;
        document.getElementById('editContent').value = content;
        openModal('editProfilModal');
    }

    function openModal(id) {
        document.getElementById(id).style.display = 'flex';
    }

    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }
</script>
@endpush
