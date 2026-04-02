<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->longText('deskripsi');
            $table->integer('harga');
            $table->string('gambar')->nullable();

            // Relasi ke tabel categories dan brands
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');

            // Kolom Tambahan untuk fitur Filter & Badge
            $table->string('kategori'); // Isinya: 'baju', 'celana', atau 'sepatu'
            $table->string('status')->default('ready'); // Isinya: 'ready', 'sold out', atau 'sale'

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
