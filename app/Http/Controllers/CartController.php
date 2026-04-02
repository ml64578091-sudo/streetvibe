<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Menampilkan halaman keranjang belanja
     */
    public function index()
    {
        return view('cart.index');
    }

    /**
     * Menambah produk ke dalam session keranjang
     */
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        // Jika produk sudah ada di keranjang, tambah jumlahnya (quantity)
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // Jika belum ada, masukkan data baru
            $cart[$id] = [
                "nama_produk" => $product->nama_produk,
                "quantity"    => 1,
                "harga"       => $product->harga,
                "gambar"      => $product->gambar,
                "link_shopee" => $product->link_shopee
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Vibe added to your bag!');
    }

    /**
     * Menghapus produk dari keranjang berdasarkan jumlah yang diinput
     */
    public function remove(Request $request)
    {
        $id = $request->id;
        $qtyToRemove = (int) $request->input('quantity', 1); // Default hapus 1 jika tidak diisi
        $cart = session()->get('cart');

        if(isset($cart[$id])) {
            // Jika jumlah di keranjang lebih besar dari jumlah yang mau dihapus
            if($cart[$id]['quantity'] > $qtyToRemove) {
                $cart[$id]['quantity'] -= $qtyToRemove;
                $message = "Item quantity reduced by " . $qtyToRemove . ".";
            } else {
                // Jika jumlah yang dihapus sama atau lebih banyak, hapus total dari keranjang
                unset($cart[$id]);
                $message = "Item completely removed from your bag.";
            }

            session()->put('cart', $cart);
            return redirect()->back()->with('success', $message);
        }

        return redirect()->back()->with('error', 'Item not found in your bag.');
    }
}
