<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'nama_produk',
        'harga',
        'deskripsi',
        'category_id',
        'brand_id',
        'stok',        // WAJIB ADA agar stok bisa tersimpan ke database
        'status',
        'gambar',
        
    ];

    // Tambahkan ini agar Laravel otomatis mengubah stok menjadi angka (integer)
    protected $casts = [
        'stok' => 'integer',
        'harga' => 'integer',
    ];

    // Relasi ke Kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi ke Brand
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // Relasi ke Outfits
    public function outfits()
    {
        return $this->belongsToMany(Outfit::class, 'outfit_product');
    }
}
