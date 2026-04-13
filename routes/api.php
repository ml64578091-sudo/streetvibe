<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Admin\GalleryController;
use App\Models\Outfit;

/*
|--------------------------------------------------------------------------
| API Routes - StreetVibe
|--------------------------------------------------------------------------
*/

// 1. TEST KONEKSI
Route::get('/test', function () {
    return response()->json([
        'status' => 'OK',
        'message' => 'API StreetVibe Jalan lancar!'
    ]);
});

// 2. AUTHENTICATION (Public)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// 3. PUBLIC DATA (Akses Tanpa Token - Agar Tidak 401)
Route::get('/outfits', function () {
    return response()->json(['data' => Outfit::all()]);
});

Route::get('/products', [ProductController::class, 'index']);

// Endpoint Gallery untuk Flutter (Pastikan function getGalleryApi ada di Controller)
Route::get('/gallery', [GalleryController::class, 'getGalleryApi']);

/*
|--------------------------------------------------------------------------
| 4. PRIVATE DATA (Wajib Bawa Token Bearer)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    // Route user profile (Opsional untuk testing login berhasil/tidak)
    Route::get('/profile', function (\Illuminate\Http\Request $request) {
        return $request->user();
    });

});
