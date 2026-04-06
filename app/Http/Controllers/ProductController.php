<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
   public function showKategori(Request $request)
{
    $kategori = $request->query('kategori', 'baju');

    $config = [
        'jacket' => [
            'title'    => 'Jacket Collection',
            'subtitle' => 'Tampil keren dengan koleksi jacket streetwear terbaik.',
        ],
        'baju' => [
            'title'    => 'Collection T-Shirt',
            'subtitle' => 'Tampil maksimal dengan pilihan atasan streetwear terbaik.',
        ],
        'celana' => [
            'title'    => 'Collection Pants',
            'subtitle' => 'Tampil stylish dengan koleksi celana streetwear terbaik.',
        ],
        'sepatu' => [
            'title'    => 'Shoes Collection',
            'subtitle' => 'Lengkapi outfit dengan pilihan sepatu streetwear terbaik.',
        ],
    ];

    if (!array_key_exists($kategori, $config)) {
        return redirect()->route('user.products', ['kategori' => 'baju']);
    }

    $products = Product::whereHas('category', function ($query) use ($kategori) {
        $query->where('slug', $kategori)
              ->orWhere('nama_kategori', 'like', '%' . $kategori . '%');
    })->get();

    return view('products', [
        'products'    => $products,
        'pageTitle'   => $config[$kategori]['title'],
        'pageSubtitle'=> $config[$kategori]['subtitle'],
    ]);
}

    // Detail Produk
    public function show($id)
    {
        $product = Product::with(['category', 'brand'])->findOrFail($id);

        // Ambil 4 produk terkait di kategori yang sama
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $id)
            ->latest()
            ->take(4)
            ->get();

        return view('product.show', compact('product', 'relatedProducts'));
    }


    // --- TAMPILAN UNTUK ADMIN (BACK-END) ---

   public function index(Request $request)
{
    $query = Product::query();

    // Menangkap filter ?kategori=baju
    if ($request->has('kategori')) {
        $query->where('kategori', $request->kategori);
    }

    $products = $query->get();
    return view('product.index', compact('products')); // Sesuaikan dengan nama file view kamu
}
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('product.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga'       => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'brand_id'    => 'required|exists:brands,id',
            'gambar'      => 'required|image|mimes:jpeg,png,webp,jpg|max:2048',
        ]);

        $data = $request->only('nama_produk', 'harga', 'category_id', 'brand_id', 'deskripsi');

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('product.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga'       => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'brand_id'    => 'required|exists:brands,id',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only('nama_produk', 'harga', 'category_id', 'brand_id', 'deskripsi');

        if ($request->hasFile('gambar')) {
            if ($product->gambar) {
                Storage::disk('public')->delete($product->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        if ($product->gambar) {
            Storage::disk('public')->delete($product->gambar);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
