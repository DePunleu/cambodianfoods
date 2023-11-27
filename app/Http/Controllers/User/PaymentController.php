<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Exception\CardException;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Carbon\Carbon;


use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;

use App\Models\Item;
use Illuminate\Support\Facades\Session;
use Stripe\Stripe;
use Stripe\Charge;



class PaymentController extends Controller
{
    //================Checkout==================//
    public function checkout()
    {
        $user_id = Auth::id();
        $count = Cart::where('user_id',$user_id)->count();
        $cartItems = Cart::where('user_id', $user_id)->get();
        $totalPrice = 0;
        foreach ($cartItems as $cartItem) {
            $item = Item::find($cartItem->item_id);
            // Calculate the total price for each item by multiplying the item's price with the quantity in the cart
            $itemTotalPrice = $item->price * $cartItem->quantity;
            $totalPrice += $itemTotalPrice;
        }
        return view('user.home.checkout',compact('count','totalPrice'));
    }
    //================CheckoutPost==================//

    public function checkoutPost(Request $request)
    {
        $user_id = Auth::id();
        $count = Cart::where('user_id', $user_id)->count();
        $cartItems = Cart::where('user_id', $user_id)->get();
        $totalPrice = 0;
        foreach ($cartItems as $cartItem) {
            $item = Item::find($cartItem->item_id);
            // Calculate the total price for each item by multiplying the item's price with the quantity in the cart
            $itemTotalPrice = $item->price * $cartItem->quantity;
            $totalPrice += $itemTotalPrice;
        }
        $paymentMethod = $request->input('payment_method');
        if ($paymentMethod === 'card_payment') {
            $user = Auth::user();
            $userid = $user->id;
            // Retrieve data from the form
            $order_name = $request->input('order_name');
            $order_phone = $request->input('order_phone');
            $order_email = $request->input('order_email');
            $order_address = $request->input('order_address');
            // Generate the order_id for the entire order
            $order_id = now()->format('YmdHis') . Str::random(4);
            $order = new Order;
            $order->name = $order_name;
            $order->email = $order_email;
            $order->phone = $order_phone;
            $order->address = $order_address;
            $order->user_id = $userid;
            $order->payment_status = 'Paid';
            $order->delivery_status = 'Order Received';
            $order->order_id = $order_id;
            $order->save();

            foreach ($cartItems as $cartItem) {
                $item = Item::find($cartItem->item_id);
            
                $order->orderItems()->create([
                    'item_id' => $cartItem->item_id,
                    'quantity' => $cartItem->quantity,
                    'item_title' => $item->title,
                    'price' => $item->price,
                    'image' => $item->image
                ]);
                //$cartItem->delete();
            }
            return redirect('/card');
        } else {
            $paymentStatus = 'Cash';
            $user = Auth::user();
            $userid = $user->id;
            // Retrieve data from the form
            $order_name = $request->input('order_name');
            $order_phone = $request->input('order_phone');
            $order_email = $request->input('order_email');
            $order_address = $request->input('order_address');
            // Generate the order_id for the entire order
            $order_id = now()->format('YmdHis') . Str::random(4);
            $order = new Order;
            $order->name = $order_name;
            $order->email = $order_email;
            $order->phone = $order_phone;
            $order->address = $order_address;
            $order->user_id = $userid;
            $order->payment_status = $paymentStatus;
            $order->delivery_status = 'Order Received';
            $order->order_id = $order_id;
            $order->save();

            foreach ($cartItems as $cartItem) {
                $item = Item::find($cartItem->item_id);
                $order->orderItems()->create([
                    'item_id' => $cartItem->item_id,
                    'quantity' => $cartItem->quantity,
                    'item_title' => $item->title,
                    'price' => $item->price,
                    'image' => $item->image
                ]);
                $cartItem->delete();
            }
            Alert::success('Order successful!', 'Thanks for your order!');
            
            return redirect()->back();
        }
    }

    //================Show Card Form==================//
    public function card(Request $request)
    {
        $user_id = Auth::id();
        $count = Cart::where('user_id', $user_id)->count();
        $cartItems = Cart::where('user_id', $user_id)->get();
        $totalPrice = 0;
        foreach ($cartItems as $cartItem) {
            $item = Item::find($cartItem->item_id);
            // Calculate the total price for each item by multiplying the item's price with the quantity in the cart
            $itemTotalPrice = $item->price * $cartItem->quantity;
            $totalPrice += $itemTotalPrice;
        }
        return view('user.home.payment.card', compact('count', 'totalPrice'));
    }

    //================Store Card==================//
    public function cardPost(Request $request)
    {
        // dd($request->all());
        $user_id = Auth::id();
        $cartItems = Cart::where('user_id', $user_id)->get();
            $totalPrice = 0;
            foreach ($cartItems as $cartItem) {
                $item = Item::find($cartItem->item_id);
                // Calculate the total price for each item by multiplying the item's price with the quantity in the cart
                $itemTotalPrice = $item->price * $cartItem->quantity;
                $totalPrice += $itemTotalPrice;
            }
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            \Stripe\Charge::create([
                "amount" => $totalPrice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks for payment!"
            ]);
        $user = Auth::user();
        $count = Cart::where('user_id',$user_id)->count();
        $userid = Auth::user()->id;
        // Get cart items
        $cartItems = Cart::where('user_id', $userid)->get();
        foreach ($cartItems as $cartItem) {
            $cartItem->delete();
        }
        return back()->with('success', 'Payment successful!');
    }

    









}
