<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

    // public function create($products)
    // {
    //     dd($products);
    //     return view("shop.admin.products.formAddProducts")
    //         ->with('products', $products);
    // }
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
            $pathComplert = asset($path);
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
                'file_path' => $pathComplert,
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

            // ProductController::checkOutUpdate($request);

            $name = $request->newName;
            $price = $request->newPrice;
            $amount = $request->newAmount;
            $description = $request->newDescription;
            $category = $request->newCategoryId;
            $updated = now();
            if($request->hasFile('newImage')!=null){
                $path = $request->file('newImage')->storeAs('public/images',$request->file('newImage')->getClientOriginalName());
                $pathComplert = asset($path);
            }
            DB::table('products')->where('name',$request->name)->update([
                'name' => $name,
                'price' => $price,
                'amount' => $amount,
                'description' => $description,
                'category_id' => $category,
                'file_path'=>$pathComplert,
                'updated_at' => $updated,
            ]);

            $products = Product::all();
            return view("shop.admin.products.listProducts", [
                'products' => $products,
            ]);

        }
    }

    
    private function checkOutUpdate($request){
        
        if($request->newName!=null){
            DB::table('products')->where('name',$request->name)->update([
                'name'=>$request->newName,
            ]);
        }
        else if($request->newPrice!=null){
            DB::table('products')->where('name',$request->name)->update([
                'price'=>$request->newPrice
            ]);
        }
        else if($request->newAmount!=null){
            DB::table('products')->where('name',$request->name)->update([
                'price'=>$request->newAmount,
            ]);
        }
        else if($request->newCategoryId!=null){
            DB::table('products')->where('name',$request->name)->update([
                'category_id'=>$request->newCategoryId,
            ]);
        }
        else if($request->newDescription!=null){
            DB::table('products')->where('name',$request->name)->update([
                'description'=>$request->newDescription,
            ]);
        }
        else if($request->hasFile('newImage')!=null){
            $path = $request->file('newImage')->storeAs('public/images',$request->file('newImage')->getClientOriginalName());
            $pathComplert = asset($path);
            DB::table('products')->where('name',$request->name)->update([
                'file_path'=>$pathComplert,
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
