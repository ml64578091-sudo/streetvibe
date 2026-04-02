<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Masukkan semua kolom yang boleh diisi (Fillable)
    protected $fillable = [
        'nama_produk',
        'harga',
        'deskripsi',
        'category_id',
        'kategori',
        'brand_id',
        'status',
        'gambar',
        'link_shopee' // Tambahkan ini jika sudah migrasi tadi
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

    // RELASI KE OUTFITS (Cukup tulis SATU KALI saja)
    public function outfits()
    {
        // Gunakan tabel perantara 'outfit_product'
        return $this->belongsToMany(Outfit::class, 'outfit_product');
    }
}
