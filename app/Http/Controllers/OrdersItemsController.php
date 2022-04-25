<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrdersItems;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrdersItemsController extends Controller
{
    public function minusOne($ordersItems,$ordersItems2,$ordersItems3){
        $quantity = DB::table('orders_items')->select('quantity')->where('id',$ordersItems)->where('product_id',$ordersItems2)->get();
        $price = DB::table('products')->where('id',$ordersItems2)->get();
        $total_price = DB::table('orders')->select('total_price')->where('id',$ordersItems3)->get();
         
        $quantity = $quantity[0]->quantity - 1;
        $newTotalPrice = $total_price[0]->total_price - $price[0]->price ;

        DB::table('orders_items')->where('id',$ordersItems)->where('product_id',$ordersItems2)->update([
            'quantity' => $quantity,
            'updated_at' => now(),
        ]);
        // dd($quantity);
        DB::table('orders')->where('id',$ordersItems3)->update([
            'total_price' => $newTotalPrice,
            'updated_at' => now(),
        ]);
        return redirect()->route('basket');
    }
    
    public function plusOne($ordersItems,$ordersItems2,$ordersItems3){

        $quantity = DB::table('orders_items')->where('id',$ordersItems)->where('product_id',$ordersItems2)->get();
        $price = DB::table('products')->where('id',$ordersItems2)->get();
        $total_price = DB::table('orders')->select('total_price')->where('id',$ordersItems3)->get();
        // dd($price);
        
        $quantity = $quantity[0]->quantity + 1;
        $newTotalPrice = $price[0]->price + $total_price[0]->total_price;

        DB::table('orders_items')->where('id',$ordersItems)->where('product_id',$ordersItems2)->update([
            'quantity' => $quantity,
            'updated_at' => now(),
        ]);
        // dd($quantity);
        DB::table('orders')->where('id',$ordersItems3)->update([
            'total_price' => $newTotalPrice,
            'updated_at' => now(),
        ]);

        return redirect()->route('basket');
    }

    public function delete_subOrder($subOrderId,$priceOfSubOrder){
        $user_id = Auth::user()->id;
        $total_price = DB::table('orders')->select('total_price')->where('users_id',$user_id)->get();
        $newTotalPrice = $total_price[0]->total_price - $priceOfSubOrder;
        DB::table('orders')->where('users_id',$user_id)->update([
            'total_price' => $newTotalPrice,
            'updated_at' => now(),
        ]);
        DB::table('orders_items')->where('id',$subOrderId)->delete();
        return redirect()->route('basket');
    }
    
}
