<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
use App\Models\Order;


class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'item_id',
        'item_title',
        'quantity',
        'price',
        'image',
    ];
    public function items()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

}
