<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use App\Models\Item;
use App\Models\Cart;
use App\Models\OrderItem;





class ReviewController extends Controller
{
    //====================Show Review Form=====================//
    public function review($orderId)
    {
        $user = Auth::user();
        $user_id = Auth::id();
        $count = Cart::where('user_id', $user_id)->count();
        
        //Fetching Order Item Details
        $orderItem = OrderItem::with('items')->whereHas('orders', function ($query) use ($user, $orderId) {
            $query->where('user_id', $user->id);
        })->where('item_id', $orderId)->first();
        // Find the existing review for the user and item
        $existingReview = Review::where('user_id', $user->id)->where('item_id', $orderItem->item_id)->first();
        return view('user.home.review', compact('orderItem', 'count','existingReview'));
    }
    //====================Store Review =====================//
    public function reviewPost(Request $request, $itemId)
    {
        $user = Auth::user();
        // Check if the user has ordered the item
        $orderItem = OrderItem::where('item_id', $itemId)
            ->whereHas('orders', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->first();
        if (!$orderItem) {
            return redirect()->back()->with('error', 'You are not authorized to review this item.');
        }
        // Find the existing review for the user and item
        $existingReview = Review::where('user_id', $user->id)
            ->where('item_id', $itemId)
            ->first();
        // Validate the form data
        $validatedData = $request->validate([
            'product_rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:255',
        ]);
        if ($existingReview) {
            // Update the existing review
            $existingReview->stars_rated = $validatedData['product_rating'];
            $existingReview->comment = $validatedData['comment'];
            $existingReview->save();
            $message = 'Review updated successfully.';
        } else {
            // Create a new review
            $review = new Review();
            $review->user_id = $user->id;
            $review->item_id = $itemId;
            $review->stars_rated = $validatedData['product_rating'];
            $review->comment = $validatedData['comment'];
            $review->save();
            $message = 'Review submitted successfully. Thanks for your review!';
            // Update the num_review attribute of the corresponding item
            $item = Item::find($itemId);
            $item->num_review = $item->reviews()->count();
            $item->save();
        }
        return redirect()->back()->with('success', $message);
    }

}
