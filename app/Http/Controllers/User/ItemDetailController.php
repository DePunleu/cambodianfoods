<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Item;

class ItemDetailController extends Controller
{
    //================Show Item Detail==================//
    public function item_detail($itemId)
    {
        $user_id = Auth::id();
        $count = Cart::where('user_id', $user_id)->count();
        // Fetch the item from the item database table based on $itemId
        $item = Item::with('reviews')->find($itemId);
        return view('user.home.item_detail', compact('count', 'item'));
    }

    //================AddcartPost==================//
    public function addcart(Request $request, $id)
    {
        if (Auth::id()) {
            $user_id = Auth::id();
            $item_id = $id;
            $quantity = $request->input('item_quantity');
            
            // Retrieve the item's store quantity
            $item = Item::find($item_id);
            $storeQuantity = $item->store_quantity;

            // Check if the requested quantity exceeds the available store quantity or is less than 1
            if ($quantity > $storeQuantity || $quantity < 1) {
                return redirect()->back()->with('error', 'Invalid quantity.');
            }

            // Check if the item already exists in the cart for the user
            $existingCartItem = Cart::where('user_id', $user_id)
                ->where('item_id', $item_id)
                ->first();

            if ($existingCartItem) {
                // Item already exists in the cart, increase the quantity
                $existingCartItem->quantity += $quantity != null && is_numeric($quantity) ? $quantity : 1;
                $existingCartItem->save();
            } else {
                // Item doesn't exist in the cart, create a new cart item
                $cart = new Cart;
                $cart->user_id = $user_id;
                $cart->item_id = $item_id;
                // Set the quantity based on the input value
                $cart->quantity = $quantity != null && is_numeric($quantity) ? $quantity : 1;
                $cart->save();
            }
            return redirect('/cart');
        } else {
            return redirect('/login');
        }
    }
}
