<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\PDF;

use App\Models\Menu;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;



class OrderController extends Controller
{
     //==================Show All Order=======================//
    public function order() {
        $count =1; 
        $items = Item::all();
        $orders = Order::with('orderItems')->get();
        $orderStatuses = ['Order Received','In-Progress', 'Shipped', 'Completed','Canceled'];
        return view('admin.home.order.list_order',compact('count','orders','orderStatuses','items'));
    }
    //==================End Method=======================//

    //==================Update Order Status=======================//
    public function updateOrderStatus(Request $request){
    $orderId = $request->input('orderId');
    $status = $request->input('status');
    
    // Find the order by ID
    $order = Order::find($orderId);
    
    if ($order) {
        if ($order->delivery_status === 'Completed') {
            // If the order status is already 'Completed', prevent further changes
            return response()->json(['success' => false, 'message' => 'Order status is already Completed and cannot be changed.']);
        }

        if ($order->delivery_status === 'Shipped' && $status === 'Completed') {
            // Check if the store quantity is sufficient for the order
            foreach ($order->orderItems as $orderItem) {
                $item = Item::find($orderItem->item_id);
                if ($item) {
                    if ($orderItem->quantity > $item->store_quantity) {
                        return response()->json(['success' => false, 'message' => 'Insufficient store quantity']);
                    }
                }
            }

            // If store quantity is sufficient, update delivery status and subtract quantities
            foreach ($order->orderItems as $orderItem) {
                $item = Item::find($orderItem->item_id);
                if ($item) {
                    // Subtract order quantity from store quantity
                    $item->store_quantity -= $orderItem->quantity;
                    // Ensure the store quantity doesn't go negative
                    $item->store_quantity = max(0, $item->store_quantity);
                    $item->save();
                }
            }

            // Update the delivery status to 'Completed'
            $order->delivery_status = $status;
        } elseif ($status !== 'Completed') {
            // If not transitioning to 'Completed', update the delivery status
            $order->delivery_status = $status;
        }

        $order->save();

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false, 'message' => 'Order not found']);
}



    
    
    
    //==================End Method=======================//
    //==================Update Store Quantity=======================//
   

    //==================End Method=======================//




    //==================Show Detail Order Form=======================//
      public function detail_order($id)
      {
        //   $store_quantity = Item::where('store_quantity',$store_quantity)-get();
          $order = Order::with('orderItems')->find($id);
          $items = Item::with('orderItems')->find($id);
    
          return view('admin.home.order.detail_order',compact('items','order'));
      }
    //==================End Method=======================//

    //==================Invoice=======================//
    public function invoice($orderId)
    {
        $order = Order::with('orderItems')->find($orderId);
      
        return view('admin.home.order.invoice', compact('order'));
    }
    //==================End Method=======================//
    //==================Delete Order=======================//
    public function delete_order($id_order) {
        $order = Order::find($id_order);
    
        if ($order) {
            // Check if the delivery status is 'Completed'
            if ($order->delivery_status === 'Completed') {
                return redirect('/admin/order')->with("error", "Order has already been Completed and cannot be deleted.");
            }
    
            // Delete associated order items
            $order->orderItems()->delete();
            
            // Delete the order itself
            $order->delete();
    
            return redirect('/admin/order')->with("success", "Order deleted successfully!");
        }
        
        return redirect('/admin/order')->with("error", "Order not found.");
    }
    
    //==================End Method=======================//
    //==================Show Form=======================//
    // public function create_order() {
    //     $item = Item::all();
    //     return view('admin.home.order.create_order',compact('item'));
    // }
    
    //===================== Filter Method==========================//
    
    //=====================End Method==========================//
    
    
    
    
    //==================End Method=======================//
    // //==================Store create order=======================//
    // public function create_orderPost(Request $request) {
    //     $order = new Order();
    //     $order->order_id = now()->format('YmdHis') . Str::random(4);
    //     $order->name = $request->input('order_name');
    //     $order->email = $request->input('order_email');
    //     $order->phone = $request->input('order_phone');
    //     $order->address = $request->input('order_address');
    //     $order->payment_status = $request->input('order_payment');
    //     $order->delivery_status = "Order Received";
    //     $order->save();
        
    //     $item = Item::where('title', $request->input('order_item'))->firstOrFail();
    //     $orderItem = new OrderItem();
    //     $orderItem->order_id = $order->id;
    //     $orderItem->item_id = $item->id;
    //     $orderItem->item_title = $item->title;
    //     $orderItem->quantity = $request->input('order_quantity');
    //     $orderItem->price = $item->price;
    //     $orderItem->image = $item->image;
    //     $orderItem->save();
        
    //     return redirect()->back()->with('success', 'Order created successfully!');
        
    // }
    // //==================End Method=======================//

    // //==================Show Update Order Form=======================//
    // public function update_order($id)
    // {
    //     $order = Order::with('orderItems')->find($id);
    //     $items = Item::all();
    //     return view('admin.home.order.update_order',compact('items','order'));
    // }
    // //==================Store Update Order =======================//
    // public function update_orderPost(Request $request, $id)
    // {
    //     $order = Order::find($id);
    //     $order->name = $request->input('order_name');
    //     $order->email = $request->input('order_email');
    //     $order->phone = $request->input('order_phone');
    //     $order->address = $request->input('order_address');
    //     $order->payment_status = $request->input('order_payment');
    //     $order->delivery_status = "Order Received";
    //     $order->save();
        
    //     $orderItem = OrderItem::where('order_id', $order->id)->first();
    //     $item = Item::where('title', $request->input('order_item'))->firstOrFail();
    //     if (!$orderItem) {
    //         $orderItem = new OrderItem();
    //         $orderItem->order_id = $order->id;
    //     }
    //     $orderItem->item_id = $item->id;
    //     $orderItem->item_title = $item->title;
    //     $orderItem->quantity = $request->input('order_quantity');
    //     $orderItem->price = $item->price;
    //     $orderItem->image = $item->image;
    //     $orderItem->save();
    //     return redirect()->back()->with("success", "Updated Item successfully!");
    // }

   

    

    //==================Download PDF=======================//
    // public function invoice_pdf($orderId)
    // {
        
    //     $order = Order::with('orderItems')->find($orderId);
    //     $pdf = PDF::loadView('admin.home.order.invoice', compact('order'));
    //     return $pdf->download('invoice.pdf');
    // }



}
