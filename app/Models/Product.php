<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi manual
    protected $fillable = [
        'nama_produk',
        'category_id',
        'brand_id',
        'harga',
        'gambar',
        'deskripsi',
        'kategori',
        'status'    
    ];

    /**
     * Relasi ke Tabel Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Relasi ke Tabel Brand
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
}
