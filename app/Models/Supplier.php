<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_supplier',
        'description',
    ];
    public static function rules()
    {
        return [
            'name_supplier ' => 'required|unique:suppliers,name_supplier',
            'description' => 'required',
        ];
    }
    public function items()
    {
        return $this->hasMany(Item::class);
    }

}
