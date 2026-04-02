<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Outfit extends Model
{
    protected $fillable = [
        'judul',
        'gambar',
        'deskripsi'
    ];

    /**
     * Relasi ke Products (Many-to-Many)
     * Cukup tulis SATU KALI saja di sini.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'outfit_product');
    }
}
