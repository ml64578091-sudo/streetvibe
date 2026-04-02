<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Menampilkan daftar brand
     * View: resources/views/brand/index.blade.php
     */
    public function index()
    {
        $brands = Brand::latest()->get();
        // Pastikan folder di resources/views bernama 'brand'
        return view('brand.index', compact('brands'));
    }

    /**
     * Menampilkan form tambah brand
     */
    public function create()
    {
        return view('brand.create');
    }

    /**
     * Menyimpan brand baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_brand' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('brands', 'public');
        }

        Brand::create($data);

        // Redirect ke route dengan prefix admin. dan nama jamak brands.
        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit brand
     */
    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('brand.edit', compact('brand'));
    }

    /**
     * Memperbarui data brand
     */
    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        $request->validate([
            'nama_brand' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('brands', 'public');
        }

        $brand->update($data);

        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand berhasil diperbarui!');
    }

    /**
     * Menghapus brand
     */
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        // Perbaikan: Redirect menggunakan nama route yang benar
        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand berhasil dihapus!');
    }
}
