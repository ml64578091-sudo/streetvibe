<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\Admin\OutfitController;
use App\Http\Controllers\Admin\GalleryController;
use App\Models\Product;
use App\Models\Outfit;
use App\Models\GalleryPhoto;

/*
|--------------------------------------------------------------------------
| 1. Halaman Utama
|--------------------------------------------------------------------------
*/
Route::get('/', function (Request $request) {
    $products      = Product::latest()->take(8)->get();
    $galleryPhotos = GalleryPhoto::orderBy('urutan')->orderBy('created_at', 'desc')->get();
    return view('welcome', compact('products', 'galleryPhotos'));
})->name('welcome');


/*
|--------------------------------------------------------------------------
| 2. USER — Halaman Produk Kategori (HARUS di atas route admin)
|--------------------------------------------------------------------------
*/
Route::get('/products', [ProductController::class, 'showKategori'])->name('user.products');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('products.show');

Route::get('/outfits-gallery', function () {
    $outfits = Outfit::latest()->get();
    return view('Outfit', compact('outfits'));
})->name('user.outfits.index');


/*
|--------------------------------------------------------------------------
| 3. Auth & Admin Area
|--------------------------------------------------------------------------
*/
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('outfit', OutfitController::class);

    // Gallery "Follow The Own"
    Route::get('gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::post('gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::delete('gallery/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');
    Route::post('gallery/{id}/up', [GalleryController::class, 'moveUp'])->name('gallery.moveUp');
    Route::post('gallery/{id}/down', [GalleryController::class, 'moveDown'])->name('gallery.moveDown');
});
