<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
    use HasFactory;
    protected $fillable = [
        'menu_id',
        'submenu_name',
    ];
    public static function rules()
    {
        return [
            'submenu_name' => 'required|unique:submenus,submenu_name',
        ];
    }
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
    public function items()
    {
        return $this->hasMany(Item::class);
    }
    
    
}
