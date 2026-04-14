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
use App\Http\Controllers\Admin\GalleryController;

// Models
use App\Models\Product;
use App\Models\Outfit;
use App\Models\GalleryPhoto;

/*
|--------------------------------------------------------------------------
| 1. HALAMAN UTAMA (PUBLIC)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    $products = Product::latest()->take(8)->get();
    $galleryPhotos = GalleryPhoto::orderBy('urutan', 'asc')->get();

    return view('welcome', compact('products', 'galleryPhotos'));
})->name('welcome');


/*
|--------------------------------------------------------------------------
| 2. USER AREA (WAJIB LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // PROFILE
    Route::get('/profile', function () {
        return view('profile', ['user' => Auth::user()]);
    })->name('profile');

    Route::get('/products', [ProductController::class, 'showKategori'])->name('user.products');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

    Route::get('/outfits-gallery', function () {
        $outfits = Outfit::with('products')->latest()->get();
        return view('Outfit', compact('outfits'));
    })->name('user.outfits.index');

    // CART
    Route::controller(CartController::class)->prefix('cart')->name('cart.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/add/{id}', 'add')->name('add');
        Route::post('/remove', 'remove')->name('remove');
    });
});


/*
|--------------------------------------------------------------------------
| 3. AUTHENTICATION & REDIRECT LOGIC
|--------------------------------------------------------------------------
*/
Auth::routes();

// MODIFIKASI DISINI:
// Jika user biasa mencoba akses /home, mereka akan diarahkan ke profil atau welcome
// Jika admin, mereka bisa diarahkan ke dashboard admin
Route::get('/home', function() {
    if (Auth::user()->role == 'admin') {
        return redirect()->route('admin.products.index');
    }
    return redirect()->route('profile');
})->middleware('auth')->name('home');


/*
|--------------------------------------------------------------------------
| 4. ADMIN AREA (HANYA ADMIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isAdmin']) // Middleware 'isAdmin' harus terdaftar di Kernel.php
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // User biasa yang mencoba akses link /admin/... akan kena 403 Forbidden atau mental balik
        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('brands', BrandController::class);
        Route::resource('outfit', AdminOutfitController::class);

        Route::controller(GalleryController::class)
            ->prefix('gallery')
            ->name('gallery.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/', 'store')->name('store');
                Route::delete('/{id}', 'destroy')->name('destroy');
                Route::post('/{id}/up', 'moveUp')->name('moveUp');
                Route::post('/{id}/down', 'moveDown')->name('moveDown');
            });
    });
