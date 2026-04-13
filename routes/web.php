<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\OutfitController as AdminOutfitController;

// (FIXED) Mengarahkan kembali ke folder Admin
use App\Http\Controllers\Admin\GalleryController;

// Models
use App\Models\Product;
use App\Models\Outfit;
use App\Models\GalleryPhoto;

/*
|--------------------------------------------------------------------------
| 1. HALAMAN UTAMA
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    $products = Product::latest()->take(8)->get();
    $galleryPhotos = GalleryPhoto::orderBy('urutan', 'asc')->get();

    return view('welcome', compact('products', 'galleryPhotos'));
})->name('welcome');

/*
|--------------------------------------------------------------------------
| 2. USER AREA
|--------------------------------------------------------------------------
*/
Route::get('/products', [ProductController::class, 'showKategori'])->name('user.products');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::get('/outfits-gallery', function () {
    $outfits = Outfit::with('products')->latest()->get();
    return view('Outfit', compact('outfits'));
})->name('user.outfits.index');

Route::controller(CartController::class)->prefix('cart')->name('cart.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/add/{id}', 'add')->name('add');
    Route::post('/remove', 'remove')->name('remove');
});

/*
|--------------------------------------------------------------------------
| 3. AUTH (Login/Register Web)
|--------------------------------------------------------------------------
*/
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| 4. ADMIN AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('outfit', AdminOutfitController::class);

    // (FIXED) Sudah otomatis merujuk ke App\Http\Controllers\Admin\GalleryController
    Route::controller(GalleryController::class)->prefix('gallery')->name('gallery.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::delete('/{id}', 'destroy')->name('destroy');
        Route::post('/{id}/up', 'moveUp')->name('moveUp');
        Route::post('/{id}/down', 'moveDown')->name('moveDown');
    });
});
