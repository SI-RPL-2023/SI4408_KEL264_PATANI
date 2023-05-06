<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
        public function index(){
            return view('admin.dashboard');
        }

        public function orderList(){
            $orders = Order::orderBy('created_at', 'desc')->get();
            return view('admin.orderList' , compact('orders'));
        }

    public function cancelOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'Ditolak';
        $order->save();

        return redirect()->back()->with('success', 'Order telah ditolak.');
    }

    public function sendOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'Dikirim';
        $order->save();

        return redirect()->back()->with('success', 'Order telah dikirim.');
    }


}
