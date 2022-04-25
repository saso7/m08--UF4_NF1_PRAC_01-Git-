<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;


class DashboardController extends Controller
{
    public function index()
    {
        // We will need the categories info from the data base when loging in...for that we will have to charge it from the category class
        if(Auth::user()->hasRole('user')){
            $categories = Category::all();
            // return view('userdash', [
            //     'categories' => $categories,
            // ]);
            return view('shop.user.userMainPage')
                ->with('categories', $categories);        
            
        }
        // elseif(Auth::user()->hasRole('admin')){
        //     return view('dashboard');
        // }
        elseif(Auth::user()->hasRole('admin')){

            $search = request()->query('search');
            if($search){
                // dd(request()->query('search'));
                $products = Product::where('name', 'LIKE', "%{$search}%")->simplePaginate();
            }
            else{
                $products = Product::simplePaginate();
            }
    
            return view('shop.admin.products.listProducts')
        
                ->with('products', $products);


        }
    }
}
