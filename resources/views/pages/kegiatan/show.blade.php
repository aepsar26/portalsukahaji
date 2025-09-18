@extends('layouts.app')

@section('content')
<div class="container py-10">
    <div class="max-w-3xl mx-auto">
        @if($data->image)
            <img src="{{ asset('storage/' . $data->image) }}" 
                 alt="{{ $data->title }}" 
                 class="w-full h-64 object-cover rounded-lg mb-6">
        @endif

        <h2 class="text-3xl font-bold mb-4">{{ $data->title }}</h2>
        <p class="text-gray-700 mb-6">{{ $data->content }}</p>

        <a href="{{ route('kegiatan.index') }}" 
           class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            ← Kembali ke Daftar Kegiatan
        </a>
    </div>
</div>
@endsection
