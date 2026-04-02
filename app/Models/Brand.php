<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_brand'
    ];

    // relasi ke product
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
