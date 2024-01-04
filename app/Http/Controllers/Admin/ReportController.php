<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\CSV;
use Illuminate\Auth\Events\Validated;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Carbon;


use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;


class ReportController extends Controller
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

        return view('admin.home.report.list_report', compact ('items', 'orders','count','completedOrdersTotalPrice'));
    }
    
    //==================End Method=======================//

    // //==================End Method=======================//
    // public function filter_reportByDate(Request $request)
    // {   
    //     $items = Item::with('orderItems')->get(); // Fetch all items
    //     $startDate = $request->input('start_date');
    //     $endDate = $request->input('end_date');

    //     // Filter orders based on the provided date range
    //     $orders = Order::with('orderItems')
    //         ->whereDate('created_at', '>=', $startDate)
    //         ->whereDate('created_at', '<=', $endDate)
    //         ->get();

    //     // You can pass $orders to your view for displaying the filtered results
    //     return view('admin.home.report.list_report', ['items' => $orders]);
    // }
    // //==================End Method=======================// 


  

    
}