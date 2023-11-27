<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Validated;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Menu;
use App\Models\Item;
//use App\Models\Table;
//use App\Models\Booking;
use App\Models\Order;





class DashboardController extends Controller
{
    //======Ensure that only authenticated admin users can access====//
    public function __construct()
    {
        $this->middleware('authadmin');
    }
    //=========================End Method============================//

    //==========================Dashboard Admin======================//
    public function dashboard()
    {
        $menus_count = Menu::all()->count();
        $items_count = Item::all()->count();
        $orders_count = Order::all()->count();
        // Total price of completed orders
        $completedOrdersTotalPrice = Order::where('delivery_status', 'Completed')
        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->sum(DB::raw('order_items.price * order_items.quantity'));
        $users_count = User::where('role', '0')->count();
        $users = User::where('role', '0')->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        $labels = [];
        $data = [];
        $colors = ['#EEE418','#18EE22','#EE8D18','#18EEDE','#18A3EE','#18EEB7',
            '#8618EE','#C418EE','#EE18AD','#EE1818','#18EEBA','#EE7318'];
        for ($i=1; $i<13; $i++) {
            $month = date('F', mktime(0,0,0,$i,1));
            $count = 0;
            foreach ($users as $user) {
                if ($user->month == $i) {
                    $count = $user->count;
                    break;
                }
            }
            array_push($labels, $month);
            array_push($data, $count);
        }
        $datasets = [
            [
                'label' => 'Total Users (' . $users_count . ')',
                'data' => $data,
                'backgroundColor' => $colors
            ]   
        ];
        // Pie chart for order delivery statuses
        $deliveryStatusCounts = Order::select('delivery_status', DB::raw('count(*) as count'))
        ->groupBy('delivery_status')
        ->get();
        $orderLabels = [];
        $orderData = [];
        foreach ($deliveryStatusCounts as $statusCount) {
            $statusLabel = ucwords(str_replace('_', ' ', $statusCount->delivery_status));
            array_push($orderLabels, $statusLabel);
            array_push($orderData, $statusCount->count);
        }
        $orderDataset = [
            [
                'data' => $orderData,
                'backgroundColor' => $colors
            ]   
        ];
        return view('admin.home.dashboard', compact('menus_count','items_count',//'bookings_count',
        //'tables_count',
        'users_count', 'orders_count','completedOrdersTotalPrice',
        'datasets', 'labels', 'orderDataset', 'orderLabels'));
    }
    //=========================End Method============================//   



}
