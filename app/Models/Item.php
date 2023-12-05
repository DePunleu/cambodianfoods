<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;
use App\Models\OrderItem;
use App\Models\Supplier;
use App\Models\Menu;





class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'origin_price',
        'price',
        'supplier_id',
        'menu_id',
        'description',
        'image',
        'num_review',
        'discount',
    ];
    public function suppliers()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    
    public function menus()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'item_id');
    }
    public function carts()
    {
        return $this->hasMany(Cart::class, 'item_id');
    }

    public function  filter()
    {
        return $this->hasMany(Menu::class, 'name_menu');
    }
   

    // public function orders()
    // {
    //     return $this->belongsToMany(Order::class, 'order_items')
    //                 ->withPivot('quantity', 'item_title', 'price', 'image');
    // }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

}
