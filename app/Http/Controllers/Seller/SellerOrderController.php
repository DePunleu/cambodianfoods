<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\PDF;

use App\Models\Menu;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;



class SellerOrderController extends Controller
{
     //==================Show All Order=======================//
    public function order() {
        $count = 1;
        $orders = Order::with('orderItems')->get();
        $orderStatuses = ['Order Received','In-Progress', 'Shipped', 'Completed','Canceled'];
        return view('seller.home.order.list_order',compact('count','orders','orderStatuses'));
    }
     //==================Update Order Status=======================//
    public function updateOrderStatus(Request $request)
    {
        $orderId = $request->input('orderId');
        $status = $request->input('status');
        // Find the order by ID
        $order = Order::find($orderId);
        if ($order) {
            // Update the delivery status
            $order->delivery_status = $status;
            $order->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Order not found']);
    }

     //==================Show Form=======================//
    public function create_order() {
        $item = Item::all();
        return view('seller.home.order.create_order',compact('item'));
    }
    //==================Store create order=======================//
    public function create_orderPost(Request $request) {
        $order = new Order();
        $order->order_id = now()->format('YmdHis') . Str::random(4);
        $order->name = $request->input('order_name');
        $order->email = $request->input('order_email');
        $order->phone = $request->input('order_phone');
        $order->address = $request->input('order_address');
        $order->payment_status = $request->input('order_payment');
        $order->delivery_status = "Order Received";
        $order->save();
        
        $item = Item::where('title', $request->input('order_item'))->firstOrFail();
        $orderItem = new OrderItem();
        $orderItem->order_id = $order->id;
        $orderItem->item_id = $item->id;
        $orderItem->item_title = $item->title;
        $orderItem->quantity = $request->input('order_quantity');
        $orderItem->price = $item->price;
        $orderItem->image = $item->image;
        $orderItem->save();
        
        return redirect()->back()->with('success', 'Order created successfully!');
        
    }
    //==================Show Update Order Form=======================//
    public function update_order($id)
    {
        $order = Order::with('orderItems')->find($id);
        $items = Item::all();
        return view('seller.home.order.update_order',compact('items','order'));
    }
    //==================Store Update Order =======================//
    public function update_orderPost(Request $request, $id)
    {
        $order = Order::find($id);
        $order->name = $request->input('order_name');
        $order->email = $request->input('order_email');
        $order->phone = $request->input('order_phone');
        $order->address = $request->input('order_address');
        $order->payment_status = $request->input('order_payment');
        $order->delivery_status = "Order Received";
        $order->save();
        
        $orderItem = OrderItem::where('order_id', $order->id)->first();
        $item = Item::where('title', $request->input('order_item'))->firstOrFail();
        if (!$orderItem) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
        }
        $orderItem->item_id = $item->id;
        $orderItem->item_title = $item->title;
        $orderItem->quantity = $request->input('order_quantity');
        $orderItem->price = $item->price;
        $orderItem->image = $item->image;
        $orderItem->save();
        return redirect()->back()->with("success", "Updated Item successfully!");
    }

    //==================Delete Order=======================//
    public function delete_order($id_order) {
        $order = Order::find($id_order);
        if ($order) {
            // Delete associated order items
            $order->orderItems()->delete();
            // Delete the order itself
            $order->delete();
            return redirect('/seller/order')->with("success", "Order deleted successfully!");
        }
        return redirect('/seller/order')->with("error", "Order not found.");
    }

    //==================Invoice=======================//
    public function invoice($orderId)
    {
        $order = Order::with('orderItems')->find($orderId);
        return view('seller.home.order.invoice', compact('order'));
    }

    //==================Download PDF=======================//
    // public function invoice_pdf($orderId)
    // {
        
    //     $order = Order::with('orderItems')->find($orderId);
    //     $pdf = PDF::loadView('seller.home.order.invoice', compact('order'));
    //     return $pdf->download('invoice.pdf');
    // }
    

}
