<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    // Basicly what we do in here is letting the field be fillable otherwise you won't be able to put anything into it.
    protected $fillable = [
        'customer_id',
        'total_price',
        'status',
        'created_at',
        'updated_at',

    ];

    //I need to use this function in order to associate both tables category and product
    public function OrdersItems()
    {
        return $this->hasMany(OrdersItems::class);
    }
}
