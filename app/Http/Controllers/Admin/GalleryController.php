<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    // 1. Halaman utama gallery
    public function index()
    {
        // Mengambil foto urut berdasarkan 'urutan' terkecil
        $photos = GalleryPhoto::orderBy('urutan', 'asc')->orderBy('created_at', 'desc')->get();

        // Asumsi view ada di folder views/gallery.blade.php
        return view('gallery', compact('photos'));
    }

    // 2. Upload foto baru dengan urutan dinamis
    public function store(Request $request)
    {
        $request->validate([
            'foto'    => 'required|array',
            'foto.*'  => 'image|mimes:jpg,jpeg,png,webp|max:3072',
            'caption' => 'nullable|string|max:100',
            'urutan'  => 'required|integer|min:0',
        ]);

        $requestedOrder = $request->urutan;

        if ($request->hasFile('foto')) {
            $files = $request->file('foto');
            $jumlahUpload = count($files);

            // LOGIKA GESER URUTAN:
            // Jika ada foto yang sudah menempati urutan ini atau di bawahnya,
            // geser urutan mereka ke bawah sebanyak jumlah foto yang diupload.
            GalleryPhoto::where('urutan', '>=', $requestedOrder)->increment('urutan', $jumlahUpload);

            // Proses simpan setiap foto
            foreach ($files as $file) {
                $path = $file->store('gallery', 'public');

                GalleryPhoto::create([
                    'foto'    => $path,
                    'caption' => $request->caption,
                    'urutan'  => $requestedOrder++, // Angka urutan otomatis bertambah untuk tiap foto
                ]);
            }
        }

        return back()->with('success', 'Foto berhasil diunggah dengan urutan yang rapi!');
    }

    // 3. Hapus foto
    public function destroy($id)
    {
        $photo = GalleryPhoto::findOrFail($id);

        if (Storage::disk('public')->exists($photo->foto)) {
            Storage::disk('public')->delete($photo->foto);
        }

        $photo->delete();

        return back()->with('success', 'Foto berhasil dihapus permanent!');
    }

    // 4. Update urutan foto (Naik ke atas / urutan lebih kecil)
    public function moveUp($id)
    {
        $photo = GalleryPhoto::findOrFail($id);

        $prev = GalleryPhoto::where('urutan', '<', $photo->urutan)
                    ->orderBy('urutan', 'desc')
                    ->first();

        if ($prev) {
            $currentUrutan = $photo->urutan;
            $photo->update(['urutan' => $prev->urutan]);
            $prev->update(['urutan' => $currentUrutan]);

            return back()->with('success', 'Posisi foto berhasil dinaikkan!');
        }

        return back()->with('success', 'Foto sudah berada di posisi paling atas.');
    }

    // 5. Update urutan foto (Turun ke bawah / urutan lebih besar)
    public function moveDown($id)
    {
        $photo = GalleryPhoto::findOrFail($id);

        $next = GalleryPhoto::where('urutan', '>', $photo->urutan)
                    ->orderBy('urutan', 'asc')
                    ->first();

        if ($next) {
            $currentUrutan = $photo->urutan;
            $photo->update(['urutan' => $next->urutan]);
            $next->update(['urutan' => $currentUrutan]);

            return back()->with('success', 'Posisi foto berhasil diturunkan!');
        }

        return back()->with('success', 'Foto sudah berada di posisi paling bawah.');
    }
}
