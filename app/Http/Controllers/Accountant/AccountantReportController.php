<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Models\Item;
use App\Models\Order;



class AccountantReportController extends Controller
{
    //==================Start showRepor Method=======================//
    public function showReport(Request $request)
    {
        $count =1; 
        // Fetching data from the models for the report
        $items = Item::all(); // Fetch all items
        // Total price of completed orders
        $completedOrdersTotalPrice = Order::where('delivery_status', 'Completed')
        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->sum(DB::raw('order_items.price * order_items.quantity'));

        // Fetch all orders with their related order items
        $orders = Order::with('orderItems')->get();

        return view('accountant.home.report.list_report', compact ('items', 'orders','count','completedOrdersTotalPrice'));
    }
    
    //==================End Method=======================//

    //==================filter_reportByDate=======================// 
    public function filter_reportByDate(Request $request)
    {   
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Retrieve items associated with orders within the specified date range
        $items = Item::whereHas('orderItems.orders', function ($query) use ($startDate, $endDate) {
                $query->whereDate('created_at', '>=', $startDate)
                       ->whereDate('created_at', '<=', $endDate);
            })
            ->with(['orderItems' => function ($query) use ($startDate, $endDate) {
                $query->whereHas('orders', function ($orderQuery) use ($startDate, $endDate) {
                    $orderQuery->whereDate('created_at', '>=', $startDate)
                               ->whereDate('created_at', '<=', $endDate);
                });
            }])
            ->get();

        // Pass the filtered $items to the view
        return view('accountant.home.report.list_report', compact('items', 'startDate', 'endDate'));
    }
    //==================End Method=======================//

   
}
