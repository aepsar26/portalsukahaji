<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemerintahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PemerintahanController extends Controller
{
    public function index()
    {
        // Ambil Kepala Kelurahan (misal berdasarkan posisi)
        $kepala = Pemerintahan::where('position', 'Lurah Sukahaji')->first();

        // Jika juga ingin menampilkan semua pejabat
        $pemerintahans = Pemerintahan::latest()->get();

        return view('admin.pemerintahans.index', compact('kepala', 'pemerintahans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'nip'         => 'nullable|string|max:50',   // ✅ validasi nip
            'position'    => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['name', 'nip', 'position', 'description']); // ✅ ikutkan nip

        if ($request->hasFile('photo')) {
            $originalPath = $request->file('photo')->store('pemerintahans/original', 'public');
            $inputPath = storage_path('app/public/' . $originalPath);

            $outputFileName = 'pemerintahans/cleaned_' . time() . '.png';
            $outputPath = storage_path('app/public/' . $outputFileName);

            $command = "python " . base_path('scripts/remove_bg.py') . " "
                        . escapeshellarg($inputPath) . " "
                        . escapeshellarg($outputPath);

            exec($command, $output, $returnVar);

            if ($returnVar === 0 && file_exists($outputPath)) {
                $data['photo'] = $outputFileName;
                Storage::disk('public')->delete($originalPath);
            } else {
                $data['photo'] = $originalPath;
                \Log::error("RemoveBG gagal: " . implode("\n", $output));
            }
        }

        Pemerintahan::create($data);

        return redirect()->route('admin.pemerintahans.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, Pemerintahan $pemerintahan)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'nip'         => 'nullable|string|max:50',   // ✅ validasi nip
            'position'    => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['name', 'nip', 'position', 'description']); // ✅ ikutkan nip

        if ($request->hasFile('photo')) {
            if ($pemerintahan->photo) {
                Storage::disk('public')->delete($pemerintahan->photo);
            }

            $originalPath = $request->file('photo')->store('pemerintahans/original', 'public');
            $inputPath = storage_path('app/public/' . $originalPath);

            $outputFileName = 'pemerintahans/cleaned_' . time() . '.png';
            $outputPath = storage_path('app/public/' . $outputFileName);

            $command = "python " . base_path('scripts/remove_bg.py') . " "
                        . escapeshellarg($inputPath) . " "
                        . escapeshellarg($outputPath);

            exec($command, $output, $returnVar);

            if ($returnVar === 0 && file_exists($outputPath)) {
                $data['photo'] = $outputFileName;
                Storage::disk('public')->delete($originalPath);
            } else {
                $data['photo'] = $originalPath;
                \Log::error("RemoveBG gagal: " . implode("\n", $output));
            }
        }

        $pemerintahan->update($data);

        return redirect()->route('admin.pemerintahans.index')
            ->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(Pemerintahan $pemerintahan)
    {
        if ($pemerintahan->photo) {
            Storage::disk('public')->delete($pemerintahan->photo);
        }

        $pemerintahan->delete();

        return redirect()->route('admin.pemerintahans.index')
            ->with('success', 'Data berhasil dihapus!');
    }
}
