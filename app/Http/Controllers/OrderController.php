<!-- <?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    // USER - LIHAT ORDER
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('orders', compact('orders'));
    }

    // USER - CHECKOUT
    public function checkout()
    {
        $total = 100000; // nanti bisa dari cart

        Order::create([
            'user_id' => auth()->id(),
            'total_price' => $total,
            'status' => 'pending',
            'payment_method' => 'transfer'
        ]);

        return redirect()->route('orders.index');
    }

    // ADMIN - LIHAT SEMUA ORDER
    public function adminIndex()
    {
        $orders = Order::with('user')->latest()->get();

        return view('admin_orders', compact('orders'));
    }

    // ADMIN - KONFIRMASI BAYAR
    public function confirm($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'success';
        $order->save();

        return back();
    }
} -->
