<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// As product extends from model it already has all the methods to use into the database like update, insert, select, etc.
class Product extends Model
{
    use HasFactory;

    // Basicly what we do in here is letting the field be fillable otherwise you won't be able to put anything into it.
    protected $fillable = [
        'name',
        'price',
        'amount',
        'description',
        'file_name',
        'category_id',
    ];

    //In need to use this function in order to associate both tables category and product
    public function category()
    {   
        return $this->belongsTo(Category::class);
    }
}
