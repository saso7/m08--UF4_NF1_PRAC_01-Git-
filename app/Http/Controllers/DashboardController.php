<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // We will need the categories info from the data base when loging in...for that we will have to charge it from the category class
        if(Auth::user()->hasRole('user')){
            $categories = Category::all();
            $search = request()->query('search');
            if($search){
                // dd(request()->query('search'));
                $products = Product::where('name', 'LIKE', "%{$search}%")->simplePaginate();
            }
            else{
                $products = Product::simplePaginate();
            }
            return view('shop.user.userMainPage',[
                'categories' => $categories,
                'products' => $products,
            ]);
     
            
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
    public function categoryView($categoryName){
        $search = request()->query('search');
        if($search){
            // dd(request()->query('search'));
            $category_id = Category::where('id', 'LIKE', $categoryName);
            // dd($category_id);
            $products = Product::where('name', 'LIKE', "%{$search}%")->simplePaginate() and Product::where('categoryid', 'LIKE', $category_id)->simplePaginate();
        }
        else{
            $category_id = Category::select('id')->where('name',$categoryName)->get();
            $categoryId = $category_id[0]->getOriginal('id');
            $products = Product::where('category_id',$categoryId)->simplePaginate();
            // $products = DB::table('products')->where('id',$product);
            // dd($products);
        }
        $categories = Category::all();

        return view('shop.user.categoryList',[
            'categories' => $categories,
            'products' => $products,
        ]);
        // $categories = Category::all();
        // return view('shop.user.'+$categoryName)
        //     ->with('categories', $categories); 
    }
}
