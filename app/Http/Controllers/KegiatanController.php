<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::latest()->get();
        return view('pages.kegiatan.index', compact('kegiatan'));
    }

    public function show($slug)
    {
        $data = Kegiatan::where('slug', $slug)->firstOrFail();
        return view('pages.kegiatan.show', compact('data'));
    }

    // opsional: CRUD admin
    public function create()
    {
        return view('admin.kegiatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'excerpt' => 'nullable',
            'content' => 'nullable',
            'image' => 'nullable|image',
        ]);

        $slug = Str::slug($request->title);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/kegiatan', 'public');
        }

        Kegiatan::create([
            'title' => $request->title,
            'slug' => $slug,
            'excerpt' => $request->excerpt,
            'content' => $request->input('content'),
            'image' => $imagePath,
        ]);

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan!');
    }
}
