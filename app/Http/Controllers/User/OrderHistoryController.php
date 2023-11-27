<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;



class OrderHistoryController extends Controller
{
     //================OrderHistory==================//
    public function order_history()
    {
        $user_id = Auth::id();
        $count = Cart::where('user_id', $user_id)->count();
        $counts = 1;
        //$order = Order::where('user_id', $user_id)->get();
        $order = Order::with('orderItems')->where('user_id', $user_id)->get();
        
        return view('user.home.order_history', compact('count', 'order', 'counts'));
    }

    //================End Method==================//

     //================Invoice==================//
    public function invoice($orderId)
    {
        $user = Auth::user();
        $counts = 1;
        // Fetch the order items for the given orderId
        $orderItems = OrderItem::where('order_id', $orderId)->get();
        // Fetch the order associated with the user and orderId
        $order = Order::where('user_id', $user->id)->findOrFail($orderId);
        return view('user.home.invoice', compact('orderItems', 'counts', 'order'));
    }
    //================End Method==================//

    public function cancel($id)
    {
        $order = Order::find($id);
        $order->delivery_status='Canceled';
        $order->save();
        return redirect()->back();
    }

}
