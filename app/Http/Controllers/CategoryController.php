<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;


class CategoryController extends Controller
{

    public function index()
    {
        $category = Category::firstOrCreate([
            'name' => 'Prova',
        ]);
        //aixo hauria d'anar a product controller
        $product = Product::firstOrCreate([
            'name' => 'Televisió',
            'price' => 50,
            'category_id' => $category->id,
        ]);

        $products = $category->products;

        dump($category);
        dump($product);
        dd($products);
    }
}
