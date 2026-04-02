<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    // Halaman utama gallery di admin
    public function index()
    {
        $photos = GalleryPhoto::orderBy('urutan')->orderBy('created_at', 'desc')->get();
        return view('gallery', compact('photos'));
    }

    // Upload foto baru
    public function store(Request $request)
    {
        $request->validate([
            'foto.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:3072',
            'caption' => 'nullable|string|max:100',
            'urutan'  => 'nullable|integer',
        ]);

        // Support upload multiple foto sekaligus
        foreach ($request->file('foto') as $file) {
            $path = $file->store('gallery', 'public');
            GalleryPhoto::create([
                'foto'    => $path,
                'caption' => $request->caption,
                'urutan'  => $request->urutan ?? 0,
            ]);
        }

        return redirect()->route('gallery')
            ->with('success', 'Foto berhasil ditambahkan!');
    }

    // Hapus foto
    public function destroy($id)
    {
        $photo = GalleryPhoto::findOrFail($id);
        Storage::disk('public')->delete($photo->foto);
        $photo->delete();

        return redirect()->route('gallery')
            ->with('success', 'Foto berhasil dihapus!');
    }

    // Update urutan foto (naik/turun)
    public function moveUp($id)
    {
        $photo = GalleryPhoto::findOrFail($id);
        $prev  = GalleryPhoto::where('urutan', '<', $photo->urutan)
                    ->orderBy('urutan', 'desc')->first();

        if ($prev) {
            $tmpUrutan      = $prev->urutan;
            $prev->urutan   = $photo->urutan;
            $photo->urutan  = $tmpUrutan;
            $prev->save();
            $photo->save();
        }

        return redirect()->route('gallery')
            ->with('success', 'Urutan diperbarui!');
    }

    public function moveDown($id)
    {
        $photo = GalleryPhoto::findOrFail($id);
        $next  = GalleryPhoto::where('urutan', '>', $photo->urutan)
                    ->orderBy('urutan', 'asc')->first();

        if ($next) {
            $tmpUrutan      = $next->urutan;
            $next->urutan   = $photo->urutan;
            $photo->urutan  = $tmpUrutan;
            $next->save();
            $photo->save();
        }

        return redirect()->route('gallery')
            ->with('success', 'Urutan diperbarui!');
    }
}
