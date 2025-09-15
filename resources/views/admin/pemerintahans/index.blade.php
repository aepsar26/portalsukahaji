@extends('admin.layouts.app')

@section('title', 'Pemerintahan')

@section('content')
<div class="section-header">
    <h2 class="section-title">Pemerintahan</h2>
    <button class="btn" onclick="openModal('pemerintahanModal')">
        <span>+</span> Tambah Data
    </button>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-container">
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Deskripsi</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pemerintahans as $p)
                <tr>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->position }}</td>
                    <td>{{ Str::limit($p->description, 40) }}</td>
                    <td>
                        @if($p->photo)
                            <img src="{{ asset('storage/'.$p->photo) }}" width="60" style="border-radius:6px;">
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-sm btn-secondary" onclick="editPemerintahan({{ $p->id }}, '{{ addslashes($p->name) }}', '{{ addslashes($p->position) }}', `{{ addslashes($p->description) }}`)">
                            Edit
                        </button>
                        <form action="{{ route('admin.pemerintahans.destroy', $p) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" style="text-align:center">Belum ada data</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Modal Tambah --}}
<div class="modal" id="pemerintahanModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Tambah Pemerintahan</h3>
            <button class="close-btn" onclick="closeModal('pemerintahanModal')">&times;</button>
        </div>
        <form method="POST" action="{{ route('admin.pemerintahans.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" class="form-input" required>
            </div>
            <div class="form-group">
                <label>Jabatan</label>
                <input type="text" name="position" class="form-input" required>
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="description" class="form-input"></textarea>
            </div>
            <div class="form-group">
                <label>Foto</label>
                <input type="file" name="photo" class="form-input">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('pemerintahanModal')">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit --}}
<div class="modal" id="editPemerintahanModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Edit Pemerintahan</h3>
            <button class="close-btn" onclick="closeModal('editPemerintahanModal')">&times;</button>
        </div>
        <form id="editPemerintahanForm" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="form-group">
                <label>Nama</label>
                <input type="text" id="editName" name="name" class="form-input" required>
            </div>
            <div class="form-group">
                <label>Jabatan</label>
                <input type="text" id="editPosition" name="position" class="form-input" required>
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea id="editDescription" name="description" class="form-input"></textarea>
            </div>
            <div class="form-group">
                <label>Foto (biarkan kosong jika tidak diubah)</label>
                <input type="file" name="photo" class="form-input">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('editPemerintahanModal')">Batal</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function editPemerintahan(id, name, position, description) {
    document.getElementById('editPemerintahanForm').action = `/admin/pemerintahans/${id}`;
    document.getElementById('editName').value = name;
    document.getElementById('editPosition').value = position;
    document.getElementById('editDescription').value = description;
    openModal('editPemerintahanModal');
}

function openModal(id) {
    document.getElementById(id).style.display = 'flex';
}
function closeModal(id) {
    document.getElementById(id).style.display = 'none';
}
</script>
@endpush
