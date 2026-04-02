<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // API UNTUK SEMUA PRODUK
    public function index()
    {
        // Ambil produk beserta relasi kategori dan brand-nya
        $products = Product::with(['category', 'brand'])->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar Semua Produk',
            'data'    => $products
        ], 200);
    }

    // API UNTUK DETAIL PRODUK (Jika user klik salah satu baju di Flutter)
    public function show($id)
    {
        $product = Product::with(['category', 'brand'])->find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $product
        ], 200);
    }

    // API UNTUK FILTER KATEGORI (Contoh: Baju saja)
    public function filterByCategory($categoryName)
    {
        $products = Product::whereHas('category', function($q) use ($categoryName) {
            $q->where('nama_kategori', $categoryName);
        })->with(['category', 'brand'])->get();

        return response()->json([
            'success' => true,
            'category' => $categoryName,
            'data'    => $products
        ], 200);
    }
}
