<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class ProductController extends Controller
{
    public function index()
    {
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


    public function indexTV(){
        $search = request()->query('search');
        if($search){
            // dd(request()->query('search'));
            $products = Product::where('name', 'LIKE', "%{$search}%")->simplePaginate() and Product::where('id', 'LIKE', "1")->simplePaginate();
        }
        else{
            $products = Product::simplePaginate();
        }
        $categories = Category::all();

        return view('shop.user.tvList',[
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    public function productDetail($product){

        if(DB::table('products')->where('id',$product)){
            $table = DB::table('products')->where('id',$product)->get();
        }
        
        $categories = Category::all();
        return view("shop.user.productDetails", [
            'categories' => $categories,
            'product' => $table,
        ]);
    }


    public function addToBasket($product,Request $request){
        $user_id = Auth::user()->id;
        $order_id = DB::table('orders')->select('id')->where('users_id',$user_id)->where('status','pending')->get();
        
        // if the order already exists and it has been completed(payed)already means we have to create another order with same user_id
        if($order_id->isEmpty()){
            // $productPrice = DB::table('products')->select('price')->where('id',$product)->get();
            // $productPrice = $productTable->price;
            // dd($request->quantity);

            $productTotalPrice = $request->price*$request->quantity;
            DB::table('orders')->insert([
                'users_id' => $user_id,
                'total_price' => $productTotalPrice,
                'status' =>'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            // and so of course we will have to create as well the orders_items row for the new order item
            $order_id = DB::table('orders')->select('id')->where('users_id',$user_id)->where('status','pending')->get();
            DB::table('orders_items')->insert([
                'order_id' => $order_id[0]->id,
                'product_id' => $product,
                'quantity' =>$request->quantity,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        else{
            // without this little readjustment we are not able to work with it
            $order_id = $order_id[0]->id;
            // otherwise if the user_id order already exists we will have to do some verifications in order to update the total price 
            // of the order and the quantity the user is buying in the orders_items table

            $product_quantity = DB::table('orders_items')->select('quantity')->where('order_id',$order_id)->where('product_id',$product)->get();
            if($product_quantity->isEmpty()){
                DB::table('orders_items')->insert([
                    'order_id' => $order_id,
                    'product_id' => $product,//id_product which comes from the form
                    'quantity' => $request->quantity,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            else{
                $product_quantity = $product_quantity[0]->quantity;
                $newTotalProductQuantity = $request->quantity+$product_quantity;
                
                DB::table('orders_items')->where('order_id',$order_id)->where('product_id',$product)->update([
                    'quantity' => $newTotalProductQuantity,
                    'updated_at' => now(),
                ]);
            }

            $quantityOrderId = DB::table('orders_items')->where('order_id',$order_id)->get();

            $totalOrdersPrice = [];
            $spins =  count($quantityOrderId);
            for($i=0;$i<$spins;$i++){
                $productId = $quantityOrderId[$i]->product_id;
                $productPrice = DB::table('products')->select('price')->where('id',$productId)->get();
                $productQuantity = $quantityOrderId[$i]->quantity;
                $orderTotalPrice = $productPrice[0]->price* $productQuantity;
                $totalOrdersPrice = Arr::prepend($totalOrdersPrice, $orderTotalPrice);
                
            }
            $totalSumSameOrdersDiferentProducts = array_sum($totalOrdersPrice);

            DB::table('orders')->where('id',$order_id)->update([
                'total_price' => $totalSumSameOrdersDiferentProducts,
                'updated_at' => now(),
            ]);
            
        }
        $products = Product::all();
        $categories = Category::all();
        return view("shop.user.tvList", [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
    

    public function create()
    {
        $products = Product::all();
        $only_id = [];
        foreach($products as $product){
            array_push($only_id, $product->category_id);
        }
        $productsId = array_unique($only_id);
        sort($productsId);
        return view("shop.admin.products.formAddProducts")
            ->with('productsId',$productsId);
    }


    public function add(Request $request)
    {
        
        // request()->validate([
        //     'file_name' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
        
        // $file = $request->file_name;
        if($request->hasFile('file_name')){

            // $file = $request->file('file_name');
            $path = $request->file('file_name')->storeAs('public/images',$request->file('file_name')->getClientOriginalName());
            // $pathComplert = asset($path);
            // dd($pathComplert);

            
            $name = $request->name;
            $price = $request->price;
            $amount = $request->amount;
            $description = $request->description;
            $filePath = $path;
            $category = $request->category_id;
            $created = now();
            $updated = now();

            // $product = DB::insert('insert into products(name,price) values ('+$name+','+$price+')');
            DB::table('products')->insert([
                'name' => $name,
                'price' => $price,
                'amount' => $amount,
                'description' => $description,
                'file_path' => $path,
                'category_id' => $category,
                'created_at' => $created,
                'updated_at' => $updated,
            ]);
            $products = Product::all();
            return view("shop.admin.products.listProducts", [
                'products' => $products,
            ]);
        }
        else{
            print(  "<div style='cursor: pointer;text-align:center;display:grid;justify-items: center;'>
                        <div style='display:grid;border:black solid 1px;align-items: center;width:100px;height:50px;'>
                            <a href={{"+route('products')+"}}>
                                <button >Back</button>
                            </a>
                        </div>
                    </div>");
        }
    }
    public function formEdit($product){
        if(DB::table('products')->where('id',$product)){
            $table = DB::table('products')->where('id',$product)->get();
        }
        return view("shop.admin.products.formEditProducts", [
            'products' => $table,
        ]);
    }



    public function edit(Request $request)
    {
        if(DB::table('products')->where('name',$request->name)){
            $name = $request->newName;
            $price = $request->newPrice;
            $amount = $request->newAmount;
            $description = $request->newDescription;
            $category = $request->newCategoryId;
            $updated = now();
            if($request->hasFile('newImage')!=null){
                $path = $request->file('newImage')->storeAs('public/images',$request->file('newImage')->getClientOriginalName());
                // $pathComplert = asset($path);
            }
            else{
                $table = DB::table('products')->where('name',$name)->get();
                $path = $table[0]->file_path;
            }
            DB::table('products')->where('name',$request->name)->update([
                'name' => $name,
                'price' => $price,
                'amount' => $amount,
                'description' => $description,
                'category_id' => $category,
                'file_path'=>$path,
                'updated_at' => $updated,
            ]);

            $products = Product::all();
            return view("shop.admin.products.listProducts", [
                'products' => $products,
            ]);

        }
    }



    public function delete($product)
    {
        if(DB::table('products')->where('id',$product)){
            DB::table('products')->where('id',$product)->delete();
            $products = Product::all();
            return view("shop.admin.products.listProducts", [
                'products' => $products,
            ]);
        }
        else{
            $message = "The items has not been found";
            return $message;
        }

    }
}
