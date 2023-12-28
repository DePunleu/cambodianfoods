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
        // Fetch all orders with their related order items
        $orders = Order::with('orderItems')->get();
        // Fetching Order Statuses
        $orderStatuses = ['Order Received','In-Progress', 'Delivering', 'Completed','Canceled'];
        $selectedStatus = $request->input('status');
        $selectedDate = $request->input('date');
 
        return view('admin.home.report.list_order_report', compact ('items', 'orders','count',
        'orderStatuses', 'selectedStatus', 'selectedDate' ));
    }
    
    //==================End Method=======================//

    public function filterOrders_reportByDate (Request $request){
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
        return view('admin.home.report.list_order_report', compact('count', 'orders', 'orderStatuses', 'items', 'selectedStatus'));       
    }
    //==================End Method=======================//
 

    
    
}
