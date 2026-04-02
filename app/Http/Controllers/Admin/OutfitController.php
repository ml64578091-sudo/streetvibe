<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Outfit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OutfitController extends Controller
{
    /**
     * Menampilkan daftar outfit (Halaman Index)
     * View: resources/views/outfit/index.blade.php
     */
    public function index()
    {
        $outfits = Outfit::latest()->get();
        return view('outfit.index', compact('outfits'));
    }

    /**
     * Menampilkan form tambah outfit
     * View: resources/views/outfit/create.blade.php
     */
    public function create()
    {
        return view('outfit.create');
    }

    /**
     * Menyimpan data outfit baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'deskripsi' => 'nullable',
        ]);

        // Proses Upload Gambar
        $path = $request->file('gambar')->store('outfits', 'public');

        // Simpan ke Database
        Outfit::create([
            'judul' => $request->judul,
            'gambar' => $path,
            'deskripsi' => $request->deskripsi,
        ]);

        // Redirect menggunakan Route Name dari web.php (admin.outfit.index)
        return redirect()->route('admin.outfit.index')->with('success', 'Outfit berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit outfit
     * View: resources/views/outfit/edit.blade.php
     */
    public function edit($id)
    {
        $outfit = Outfit::findOrFail($id);
        return view('outfit.edit', compact('outfit'));
    }

    /**
     * Memperbarui data outfit di database
     */
    public function update(Request $request, $id)
    {
        $outfit = Outfit::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($outfit->gambar) {
                Storage::disk('public')->delete($outfit->gambar);
            }
            // Upload gambar baru
            $path = $request->file('gambar')->store('outfits', 'public');
            $outfit->gambar = $path;
        }

        $outfit->judul = $request->judul;
        $outfit->deskripsi = $request->deskripsi;
        $outfit->save();

        return redirect()->route('admin.outfit.index')->with('success', 'Outfit berhasil diupdate!');
    }

    /**
     * Menghapus data outfit
     */
    public function destroy($id)
    {
        $outfit = Outfit::findOrFail($id);

        // Hapus file gambar dari storage
        if ($outfit->gambar) {
            Storage::disk('public')->delete($outfit->gambar);
        }

        $outfit->delete();

        return redirect()->route('admin.outfit.index')->with('success', 'Outfit berhasil dihapus!');
    }
}
