<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Outfit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OutfitController extends Controller
{
    public function index()
    {
        $outfits = Outfit::latest()->get();
        return view('outfit.index', compact('outfits'));
    }

    public function create()
    {
        return view('outfit.create');
    }

    public function store(Request $request)
    {
        // Validasi disesuaikan dengan nama input di form (instagram_username)
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'instagram_username' => 'required|string|max:100',
        ]);

        // Proses Upload Gambar
        $path = $request->file('gambar')->store('outfits', 'public');

        // Simpan ke Database (instagram_username disimpan ke kolom deskripsi)
        Outfit::create([
            'judul' => $request->judul,
            'gambar' => $path,
            'deskripsi' => $request->instagram_username,
        ]);

        return redirect()->route('admin.outfit.index')->with('success', 'Outfit berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $outfit = Outfit::findOrFail($id);
        return view('outfit.edit', compact('outfit'));
    }

    public function update(Request $request, $id)
    {
        $outfit = Outfit::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'instagram_username' => 'required|string|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($outfit->gambar) {
                Storage::disk('public')->delete($outfit->gambar);
            }
            $path = $request->file('gambar')->store('outfits', 'public');
            $outfit->gambar = $path;
        }

        $outfit->judul = $request->judul;
        // Update username instagram ke kolom deskripsi
        $outfit->deskripsi = $request->instagram_username;
        $outfit->save();

        return redirect()->route('admin.outfit.index')->with('success', 'Outfit berhasil diupdate!');
    }

    public function destroy($id)
    {
        $outfit = Outfit::findOrFail($id);

        if ($outfit->gambar) {
            Storage::disk('public')->delete($outfit->gambar);
        }

        $outfit->delete();

        return redirect()->route('admin.outfit.index')->with('success', 'Outfit berhasil dihapus!');
    }
}
