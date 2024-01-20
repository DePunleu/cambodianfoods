<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Menu;
use App\Models\Item;
use App\Models\Order;





class AccountantDashboardController extends Controller
{
    //======Ensure that only authenticated accountant users can access====//
    public function __construct()
    {
        $this->middleware('authaccountant');
    }
    //=========================End Method============================//

    //==========================Dashboard Accountant======================//
    public function dashboard()
    {
        $foods_count = Item::where('menu_id', 1)->count();
        $combo_count = Item::where('menu_id', 2)->count();
        $dessert_count = Item::where('menu_id', 3)->count();
        $drink_count = Item::where('menu_id', 4)->count();
        $orders_count = Order::all()->count();
        // Total price of completed orders
        $completedOrdersTotalPrice = Order::where('delivery_status', 'Completed')
        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->sum(DB::raw('order_items.price * order_items.quantity'));

        // Chart User
        $users_count = User::where('role', 'user')->count();
        $users = User::where('role', 'user')->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        // Preparing Data for Charting
        $labels = []; // array to hold month names
        $data = []; // array to hold user counts
        $colors = ['#EEE418','#18EE22','#EE8D18','#18EEDE','#18A3EE','#18EEB7',
            '#8618EE','#C418EE','#EE18AD','#EE1818','#18EEBA','#EE7318'];
        // Loops through the 12 months of a year
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

        $ordersByDay = Order::selectRaw('DATE(created_at) as date, COUNT(*) as count')
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        // Fetch orders grouped by week
        $ordersByWeek = Order::selectRaw('YEARWEEK(created_at) as week, COUNT(*) as count')
            ->groupBy('week')
            ->orderBy('week')
            ->get();

        // Fetch orders grouped by month
        $ordersByMonth = Order::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Fetch orders grouped by year
        $ordersByYear = Order::selectRaw('YEAR(created_at) as year, COUNT(*) as count')
            ->groupBy('year')
            ->orderBy('year')
            ->get();

       
        return view('accountant.home.dashboard', compact('users_count', 'orders_count','completedOrdersTotalPrice',
        'datasets', 'labels', 'orderDataset', 'orderLabels', 'foods_count', 'combo_count', 'dessert_count', 'drink_count',
        'ordersByDay','ordersByWeek','ordersByMonth','ordersByYear'));
    }

}
    //=========================End Method============================//  
    
