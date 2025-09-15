{{-- resources/views/admin/budgets/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Anggaran Desa')

@section('content')
    <div class="section-header">
        <h2 class="section-title">Anggaran Desa</h2>
        <button class="btn" onclick="openModal('budgetModal')">
            <span>+</span> Tambah Anggaran
        </button>
    </div>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Label</th>
                    <th>Jumlah (Amount)</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($budgets as $budget)
                    <tr>
                        <td>{{ $budget->id }}</td>
                        <td>{{ $budget->label }}</td>
                        <td>{{ number_format($budget->amount, 0, ',', '.') }}</td>
                        <td>{{ $budget->created_at->format('d-m-Y') }}</td>
                        <td class="action-buttons">
                            <button class="btn btn-sm btn-secondary"
                                onclick="editBudget({{ $budget->id }}, '{{ addslashes($budget->label) }}', {{ $budget->amount }})">
                                Edit
                            </button>
                            <form id="delete-form-{{ $budget->id }}" method="POST" 
                                  action="{{ route('admin.budgets.destroy', $budget) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger" 
                                        onclick="confirmDelete('delete-form-{{ $budget->id }}')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center; padding:2rem; color:#64748b;">
                            Belum ada data Anggaran
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah -->
    <div class="modal" id="budgetModal" style="display:none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Tambah Anggaran</h3>
                <button class="close-btn" onclick="closeModal('budgetModal')">&times;</button>
            </div>
            <form method="POST" action="{{ route('admin.budgets.store') }}">
                @csrf
                <div class="form-group">
                    <label>Label</label>
                    <input type="text" name="label" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Jumlah (Amount)</label>
                    <input type="number" name="amount" class="form-input" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('budgetModal')">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal" id="editBudgetModal" style="display:none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit Anggaran</h3>
                <button class="close-btn" onclick="closeModal('editBudgetModal')">&times;</button>
            </div>
            <form method="POST" id="editBudgetForm">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Label</label>
                    <input type="text" id="editLabel" name="label" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Jumlah (Amount)</label>
                    <input type="number" id="editAmount" name="amount" class="form-input" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('editBudgetModal')">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function editBudget(id, label, amount) {
        document.getElementById('editBudgetForm').action = `/admin/budgets/${id}`;
        document.getElementById('editLabel').value = label;
        document.getElementById('editAmount').value = amount;
        openModal('editBudgetModal');
    }

    function openModal(id) {
        document.getElementById(id).style.display = 'flex';
    }

    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }
</script>
@endpush
