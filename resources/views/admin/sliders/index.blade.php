@extends('admin.layouts.app')

@section('title', 'Slider Homepage')

@section('content')
    <div class="section-header">
        <h2 class="section-title">Slider Homepage</h2>
        <button class="btn" onclick="openModal('sliderModal')">
            <span>+</span> Tambah Slider
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
                    <th>Gambar</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sliders as $slider)
                    <tr>
                        <td>{{ $slider->id }}</td>
                        <td>
                            @if($slider->image)
                                <img src="{{ asset('storage/' . $slider->image) }}" alt="Slider" width="120">
                            @else
                                <span style="color:#94a3b8;">Tidak ada</span>
                            @endif
                        </td>
                        <td>{{ $slider->created_at->format('d-m-Y') }}</td>
                        <td>
                            <button class="btn btn-sm btn-secondary"
                                onclick="editSlider({{ $slider->id }}, {{ json_encode($slider->image) }})">
                                Edit
                            </button>
                            <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin ingin hapus slider ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center; padding:1rem; color:#94a3b8;">
                            Belum ada data slider
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah Slider -->
    <div class="modal" id="sliderModal" style="display:none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Tambah Slider</h3>
                <button class="close-btn" onclick="closeModal('sliderModal')">&times;</button>
            </div>
            <form method="POST" action="{{ route('admin.sliders.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Gambar</label>
                    <input type="file" name="image" class="form-input" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('sliderModal')">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Slider -->
    <div class="modal" id="editSliderModal" style="display:none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit Slider</h3>
                <button class="close-btn" onclick="closeModal('editSliderModal')">&times;</button>
            </div>
            <form method="POST" id="editSliderForm" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="form-group">
                    <label>Gambar Lama</label><br>
                    <img id="currentSliderImage" src="" alt="Preview" style="width:150px; margin-bottom:10px; display:none; border-radius:6px;">
                </div>
                <div class="form-group">
                    <label>Ganti Gambar (Opsional)</label>
                    <input type="file" name="image" class="form-input">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('editSliderModal')">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function editSlider(id, image) {
        document.getElementById('editSliderForm').action = `/admin/sliders/${id}`;

        const currentImage = document.getElementById('currentSliderImage');
        if (image) {
            currentImage.src = `/storage/${image}`;
            currentImage.style.display = 'block';
        } else {
            currentImage.style.display = 'none';
        }

        openModal('editSliderModal');
    }

    function openModal(id) {
        document.getElementById(id).style.display = 'flex';
    }

    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }
</script>
@endpush
