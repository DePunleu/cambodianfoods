<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\CSV;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Carbon;



use App\Models\Menu;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;



class OrderController extends Controller
{
    // ==================Show All Order=======================//
    public function order() {
        $count =1; 
        $items = Item::all();
        $orders = Order::with('orderItems')->get();
        $orderStatuses = ['Order Received','In-Progress', 'Delivering', 'Completed','Canceled'];
        $selectedStatus = Order::all();
        return view('admin.home.order.list_order',compact('count','orders','orderStatuses','items','selectedStatus'));
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

        if ($order->delivery_status === 'Delivering' && $status === 'Completed') {
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
   
    

    //==================filterOrdersByDate=======================//

    public function filterOrdersByDate(Request $request){
        $count = 1; 
        $items = Item::all();
        $orderStatuses = ['Order Received','In-Progress', 'Delivering', 'Completed','Canceled'];
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $selectedStatus = $request->input('status'); // Assuming 'status' is the field name for status filtering
    
        $ordersQuery = Order::with('orderItems')
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate);
    
        if ($selectedStatus && in_array($selectedStatus, $orderStatuses)) {
            $ordersQuery->where('delivery_status', $selectedStatus);
        }
    
        $orders = $ordersQuery->get();
    
        // You can then pass $orders to a view to display the filtered orders
        return view('admin.home.order.list_order', compact('count', 'orders', 'orderStatuses', 'items', 'selectedStatus'));       
    }
    //==================End Method=======================//

//     //==================Order Report=======================//

//     public function orderReport(){
//         $todayOrdersCount = Order::whereDate('created_at', Carbon::today())->count();

//         // For a week
//         $startOfWeek = Carbon::now()->startOfWeek();
//         $endOfWeek = Carbon::now()->endOfWeek();
//         $weekOrdersCount = Order::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();

//         // For a month
//         $startOfMonth = Carbon::now()->startOfMonth();
//         $endOfMonth = Carbon::now()->endOfMonth();
//         $monthOrdersCount = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();

//         // For a year
//         $startOfYear = Carbon::now()->startOfYear();
//         $endOfYear = Carbon::now()->endOfYear();
//         $yearOrdersCount = Order::whereBetween('created_at', [$startOfYear, $endOfYear])->count();


//         return view('admin.home.order.order_report')->with([
//             'todayOrdersCount' => $todayOrdersCount,
//             'weekOrdersCount' => $weekOrdersCount,
//             'monthOrdersCount' => $monthOrdersCount,
//             'yearOrdersCount' => $yearOrdersCount,
//         ]);
//     }
//     public function exportOrders(){
//     $orders = Order::all(); // Fetch all orders

//     $headers = [
//         'Content-Type' => 'text/csv',
//         'Content-Disposition' => 'attachment; filename="orders.csv"',
//     ];

//     $callback = function () use ($orders) {
//         $file = fopen('php://output', 'w');

//         // Add headers to the CSV file
//         fputcsv($file, ['Order ID', 'Customer Name', 'Total', 'Order Date', 'Status']);

//         // Add orders data to the CSV file
//         foreach ($orders as $order) {
//             fputcsv($file, [
//                 $order->id,
//                 $order->name,
//                 $order->orderItems->sum(function ($orderItem) {
//                     return $orderItem->price * $orderItem->quantity;
//                 }),
//                 $order->created_at,
//                 $order->delivery_status,
//             ]);
//         }

//         fclose($file);
//     };

//     return Response::stream($callback, 200, $headers);
//     }
//     //==================End Method=======================//


}
