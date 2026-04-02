<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Pastikan Model Product di-import

class HomeController extends Controller
{
    public function index()
    {
        // Menghitung total jumlah produk
        $total_produk = Product::count();

        // Mengambil semua data produk beserta relasinya untuk tabel
        $products = Product::with(['category', 'brand'])->latest()->get();

        // Kirim kedua variabel ke view
        return view('home', compact('total_produk', 'products'));
    }
}
