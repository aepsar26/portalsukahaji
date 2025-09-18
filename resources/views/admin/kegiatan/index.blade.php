@extends('admin.layouts.app')

@section('title', 'Kegiatan Kelurahan')

@section('content')
    <div class="section-header">
        <h2 class="section-title">Kegiatan Kelurahan</h2>
        <button class="btn" onclick="openModal('kegiatanModal')">
            <span>+</span> Tambah Kegiatan
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
                    <th>Slug</th>
                    <th>Gambar</th>
                    <th>Excerpt</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kegiatan as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->slug }}</td>
                        <td>
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="gambar" width="60">
                            @else
                                <span style="color:#9ca3af;">-</span>
                            @endif
                        </td>
                        <td style="max-width:250px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                            {{ $item->excerpt }}
                        </td>
                        <td>
                            <button class="btn btn-sm btn-secondary"
                                onclick="editKegiatan({{ $item->id }}, '{{ addslashes($item->title) }}', '{{ addslashes($item->excerpt) }}', '{{ addslashes($item->content) }}')">
                                Edit
                            </button>
                            <form action="{{ route('admin.kegiatan.destroy', $item) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Hapus kegiatan ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" style="text-align:center; padding:2rem;">Belum ada kegiatan</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Modal Tambah --}}
    <div class="modal" id="kegiatanModal" style="display:none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Tambah Kegiatan</h3>
                <button class="close-btn" onclick="closeModal('kegiatanModal')">&times;</button>
            </div>
            <form method="POST" action="{{ route('admin.kegiatan.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" name="title" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Excerpt</label>
                    <input type="text" name="excerpt" class="form-input">
                </div>
                <div class="form-group">
                    <label>Konten</label>
                    <textarea name="content" class="form-input" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label>Gambar</label>
                    <input type="file" name="image" class="form-input">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('kegiatanModal')">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal" id="editKegiatanModal" style="display:none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit Kegiatan</h3>
                <button class="close-btn" onclick="closeModal('editKegiatanModal')">&times;</button>
            </div>
            <form method="POST" id="editKegiatanForm" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" id="editTitle" name="title" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Excerpt</label>
                    <input type="text" id="editExcerpt" name="excerpt" class="form-input">
                </div>
                <div class="form-group">
                    <label>Konten</label>
                    <textarea id="editContent" name="content" class="form-input" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label>Gambar (opsional)</label>
                    <input type="file" name="image" class="form-input">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('editKegiatanModal')">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function editKegiatan(id, title, excerpt, content) {
        document.getElementById('editKegiatanForm').action = `/admin/kegiatan/${id}`;
        document.getElementById('editTitle').value = title;
        document.getElementById('editExcerpt').value = excerpt;
        document.getElementById('editContent').value = content;
        openModal('editKegiatanModal');
    }

    function openModal(id) {
        document.getElementById(id).style.display = 'flex';
    }

    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }
</script>
@endpush
