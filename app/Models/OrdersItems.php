<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersItems extends Model
{
    use HasFactory;

    // Basicly what we do in here is letting the field be fillable otherwise you won't be able to put anything into it.
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
    ];

    //In need to use this function in order to associate both tables category and product
    public function Orders()
    {   
        return $this->belongsTo(Orders::class);
    }

}
