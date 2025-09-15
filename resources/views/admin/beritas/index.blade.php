@extends('admin.layouts.app')

@section('title', 'Berita Desa')

@section('content')
    <div class="section-header">
        <h2 class="section-title">Berita Desa</h2>
        <button class="btn" onclick="openModal('beritaModal')">
            <span>+</span> Tambah Berita
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
                    <th>Tanggal</th>
                    <th>Gambar</th>
                    <th>Konten</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($beritas as $berita)
                    <tr>
                        <td>{{ $berita->id }}</td>
                        <td>{{ $berita->title }}</td>
                        <td>{{ $berita->date->format('d-m-Y') }}</td>
                        <td>
                            @if($berita->image)
                                <img src="{{ asset('storage/' . $berita->image) }}" alt="gambar" width="60">
                            @else
                                <span style="color:#9ca3af;">-</span>
                            @endif
                        </td>
                        <td style="max-width:250px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                            {{ $berita->content }}
                        </td>
                        <td>
                            <button class="btn btn-sm btn-secondary"
                                onclick="editBerita({{ $berita->id }}, '{{ addslashes($berita->title) }}', '{{ addslashes($berita->content) }}', '{{ $berita->date->format('Y-m-d') }}')">
                                Edit
                            </button>
                            <form action="{{ route('admin.beritas.destroy', $berita) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Hapus berita ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" style="text-align:center; padding:2rem;">Belum ada berita</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Modal Tambah --}}
    <div class="modal" id="beritaModal" style="display:none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Tambah Berita</h3>
                <button class="close-btn" onclick="closeModal('beritaModal')">&times;</button>
            </div>
            <form method="POST" action="{{ route('admin.beritas.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" name="title" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="date" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Konten</label>
                    <textarea name="content" class="form-input" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label>Gambar (opsional)</label>
                    <input type="file" name="image" class="form-input">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('beritaModal')">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal" id="editBeritaModal" style="display:none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit Berita</h3>
                <button class="close-btn" onclick="closeModal('editBeritaModal')">&times;</button>
            </div>
            <form method="POST" id="editBeritaForm" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" id="editTitle" name="title" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" id="editDate" name="date" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Konten</label>
                    <textarea id="editContent" name="content" class="form-input" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label>Gambar (opsional)</label>
                    <input type="file" name="image" class="form-input">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('editBeritaModal')">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function editBerita(id, title, content, date) {
        document.getElementById('editBeritaForm').action = `/admin/beritas/${id}`;
        document.getElementById('editTitle').value = title;
        document.getElementById('editContent').value = content;
        document.getElementById('editDate').value = date;
        openModal('editBeritaModal');
    }

    function openModal(id) {
        document.getElementById(id).style.display = 'flex';
    }

    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }
</script>
@endpush
