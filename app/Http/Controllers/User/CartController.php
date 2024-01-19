<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Item;

class CartController extends Controller{
   // ================AddcartPost==================//
    public function addcartPost(Request $request, $id){
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
            return redirect()->back();
        } else {
            return redirect('/login');
        }
    }
    // =================End Method==================//

    
    //================End Method==================//
    //================Show Cart==================//
    public function cart()
    {
        if(Auth::id())
        {
            $user_id = Auth::id();
            $counts = 1;
            $count = Cart::where('user_id',$user_id)->count();
            // Fetch cart details and related item information
            $cart = DB::table('carts')->where('user_id',$user_id)
            ->join('items','carts.item_id','=','items.id')
            ->select('carts.*','items.title','items.price','items.image','items.store_quantity')
            ->orderBy('carts.id','desc')->get();
            return view('user.home.cart',compact('count','cart','counts'));
        }
        else
        {
        return redirect('/login');
        }
    } 
    //================End Method==================//

    //================Update Cart==================//
    public function update_cart(Request $request)
    {   
        // Retrieve the cart ID and quantity from the request
        $cartId = $request->id;
        $quantity = $request->quantity;
        // Update the cart item with the given ID using the new quantity
        $cart = Cart::findOrFail($cartId);
        $cart->quantity = $quantity;
        $cart->save();
        return response()->json(['message' => 'Cart updated successfully']);
    }
    //================End Method==================//

    //================Delete Cart==================//
    public function delete_cart($id_cart) {
        $delete = Cart::where('id', $id_cart)->first();
        $delete->delete();
        return redirect()->back()
        ->with("success","Item deleted successfully!");
    }
    //================End Method==================//

}
