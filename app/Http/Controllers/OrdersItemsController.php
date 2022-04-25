<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrdersItems;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrdersItemsController extends Controller
{
    public function minusOne($orderId,$priceProduct,$totalPrice,$productId,$subOrderId){
        $quantity = DB::table('orders_items')->select('quantity')->where('id',$orderId)->where('product_id',$productId)->get();
        // $price = DB::table('products')->where('id',$productId)->get();
        // $total_price = DB::table('orders')->select('total_price')->where('id',$subOrderId)->get();
        // dd($price);
        $quantity = $quantity[0]->quantity - 1;
        $newTotalPrice = $totalPrice - $priceProduct ;
        // dd($quantity);
        DB::table('orders_items')->where('id',$orderId)->where('product_id',$productId)->update([
            'quantity' => $quantity,
            'updated_at' => now(),
        ]);
        // dd($quantity);
        DB::table('orders')->where('id',$subOrderId)->update([
            'total_price' => $newTotalPrice,
            'updated_at' => now(),
        ]);
        return redirect()->route('basket');
    }
    
    public function plusOne($orderId,$priceProduct,$totalPrice,$productId,$subOrderId){

        $quantity = DB::table('orders_items')->where('id',$orderId)->where('product_id',$productId)->get();
        // $price = DB::table('products')->where('id',$productId)->get();
        // $total_price = DB::table('orders')->select('total_price')->where('id',$subOrderId)->get();
        // dd($price);
        
        $quantity = $quantity[0]->quantity + 1;
        $newTotalPrice = $totalPrice + $priceProduct ;

        DB::table('orders_items')->where('id',$orderId)->where('product_id',$productId)->update([
            'quantity' => $quantity,
            'updated_at' => now(),
        ]);
        // dd($quantity);
        DB::table('orders')->where('id',$subOrderId)->update([
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
