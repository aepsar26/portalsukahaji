@extends('layouts.app')

@section('content')
<div class="container py-10">
 <div class="card-header">
    <h3>Potensi Kelurahan</h3>
</div>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($kegiatan as $item)
            <div class="p-6 rounded-xl shadow bg-white hover:shadow-lg transition">
                @if($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" 
                         alt="{{ $item->title }}" 
                         class="w-full h-40 object-cover rounded-lg mb-4">
                @endif

                <h3 class="text-xl font-semibold mb-2">
                    <a href="{{ route('kegiatan.show', $item->slug) }}" class="text-blue-600 hover:underline">
                        {{ $item->title }}
                    </a>
                </h3>
                <p class="text-gray-600 text-sm">{{ $item->excerpt }}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection
