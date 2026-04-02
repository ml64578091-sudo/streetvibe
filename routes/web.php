<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// Import Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\OutfitController as AdminOutfitController;
use App\Http\Controllers\Admin\GalleryController;

// Import Models
use App\Models\Product;
use App\Models\Outfit;
use App\Models\GalleryPhoto;

/*
|--------------------------------------------------------------------------
| 1. HALAMAN UTAMA (WELCOME)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    // Mengambil data produk, gallery, dan outfit untuk landing page
    $products = Product::latest()->take(8)->get();
    $galleryPhotos = GalleryPhoto::orderBy('urutan', 'asc')->latest()->get();

    // Pastikan variabel galleryPhotos selalu ada agar tidak error di welcome
    return view('welcome', [
        'products' => $products,
        'galleryPhotos' => $galleryPhotos
    ]);
})->name('welcome');

/*
|--------------------------------------------------------------------------
| 2. USER AREA (SHOP & KERANJANG)
|--------------------------------------------------------------------------
*/

// PERBAIKAN: Mengubah '/shop' menjadi '/products' agar sesuai dengan link di Welcome
Route::get('/products', [ProductController::class, 'index'])->name('user.products');

// Detail Produk
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Gallery Inspirasi Outfit
Route::get('/outfits-gallery', function () {
    $outfits = Outfit::with('products')->latest()->get();
    return view('Outfit', compact('outfits'));
})->name('user.outfits.index');

// --- FITUR KERANJANG ---
Route::controller(CartController::class)->prefix('cart')->name('cart.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/add/{id}', 'add')->name('add');
    Route::post('/remove', 'remove')->name('remove');
});

/*
|--------------------------------------------------------------------------
| 3. AUTH & ADMIN AREA
|--------------------------------------------------------------------------
*/

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('outfit', AdminOutfitController::class);

    Route::controller(GalleryController::class)->prefix('gallery')->name('gallery.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::delete('/{id}', 'destroy')->name('destroy');
        Route::post('/{id}/up', 'moveUp')->name('moveUp');
        Route::post('/{id}/down', 'moveDown')->name('moveDown');
    });
});
