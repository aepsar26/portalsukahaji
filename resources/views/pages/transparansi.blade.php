@extends('layouts.app')

@section('title', 'Transparansi')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Transparansi Anggaran</h3>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Jenis</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @forelse($budgets as $item)
                    <tr>
                        <td>{{ $item->label }}</td>
                        <td>Rp {{ number_format($item->amount, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">Data transparansi belum tersedia</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
