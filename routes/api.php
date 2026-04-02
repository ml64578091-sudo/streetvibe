<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;

// Jalur yang bisa diakses tanpa login (Public)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Jalur yang WAJIB pakai Token (Protected)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});



Route::middleware('auth:sanctum')->group(function () {
    // Ambil semua produk
    Route::get('/products', [ProductController::class, 'index']);

    // Ambil satu produk berdasarkan ID
    Route::get('/products/{id}', [ProductController::class, 'show']);

    // Filter produk (Baju/Celana/Sepatu)
    Route::get('/products/category/{name}', [ProductController::class, 'filterByCategory']);

    Route::post('/logout', [AuthController::class, 'logout']);
});
