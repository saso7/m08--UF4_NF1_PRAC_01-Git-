<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Orders;
use App\Models\OrdersItems;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function indexBasket(){
        $user_id = Auth::user()->id;
        $categories = Category::all();
        $orders = Orders::all()->where('users_id',$user_id);
        
        if($orders->isEmpty()){
            return view('shop.user.basket',[
                'categories' => $categories,
            ]);
        }
        else{
            // dd($orders[0]->getOriginal('id'));
            $ordersItems = DB::table('orders_items')->where('order_id',$orders[0]->getOriginal('id'))->get();
            // dd($ordersItems);
            $productNames = [];
            $productPrices = [];

            $disable = [];
            $idList = [];
            for($i=0;$i<count($ordersItems);$i++){
                $idList[$i] = $ordersItems[$i]->product_id;
                if($ordersItems[$i]->quantity==0){
                    $disable[$i] = true;
                }
                else{
                    $disable[$i] = false;
                }
            }
            // dd($disable);
            // $productNames[$i] = DB::table('products')->select('name')->where('id',$ordersItems[$i]->product_id)->get();

            
            $productNames = DB::table('products')->select('name')->whereIn('id',$idList)->get();
            // dd($productNames);
            $productPrices = DB::table('products')->select('price')->whereIn('id',$idList)->get();
            // dd($productPrices);
            $listPricePerProductTotal = [];
            for($x=0;$x<count($productPrices);$x++){
                $listPricePerProductTotal[$x] =  $ordersItems[$x]->quantity*$productPrices[$x]->price;
            }
            
            // dd($listPricePerProductTotal);
            // dd($productNames[0]->name);
            // $products = Product::all()->where('id',$ordersItems[$i]->product_id);
            // dd( $products);
            // dd($orders[0]->total_price);
            $length = count($ordersItems);
            // dd($ordersItems[0]->quantity);

            return view('shop.user.basket',[
                'categories' => $categories,
                'orders' => $orders,
                'ordersItems' => $ordersItems,
                'productNames' => $productNames,
                'productPrices' => $productPrices,
                'listOfPrices' => $listPricePerProductTotal,
                'length' => $length,
                'idList' => $idList,
                'disable' => $disable,            ]);
        }

    }
}
