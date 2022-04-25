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
    public function index(){
        $search = request()->query('search');
        if($search){
            // dd(request()->query('search'));
            $orders = Orders::where('name', 'LIKE', "%{$search}%")->simplePaginate();
        }
        else{
            $orders = Orders::simplePaginate();
        }

        return view('shop.admin.orders.listOrders')
    
            ->with('orders', $orders);
    }


    public function formEdit($order){
        if(DB::table('orders')->where('id',$order)){
            $order = DB::table('orders')->where('id',$order)->get();
        }
            
        // dd($order[0]->status);
        return view("shop.admin.orders.formEditOrders", [
            'order' => $order,
        ]);
    }


    public function edit(Request $request)
    {
        if(DB::table('orders')->where('id',$request->id)){
            $status = $request->newStatus;
            $updated = now();
            
            DB::table('orders')->where('id',$request->id)->update([
                'status' => $status,
                'updated_at' => $updated,
            ]);
            $orders = Orders::all();
            return view("shop.admin.orders.listOrders", [
                'orders' => $orders,
            ]);

        }
    }

    public function delete($order)
    {
        if(DB::table('orders')->where('id',$order)){
            DB::table('orders')->where('id',$order)->delete();
            $orders = Orders::all();
            return view("shop.admin.orders.listOrders", [
                'orders' => $orders,
            ]);
        }
        else{
            $message = "The order has not been found";
            return $message;
        }

    }


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

            $ids = implode(',', $idList);
            // dd($ids);
            // the whereIn function gives back the right information but disordered, so to solve that we will have to use the orderByRaw
            $productNames = DB::table('products')->select('name')->whereIn('id',$idList)->orderByRaw("FIELD(id, $ids)")->get();
            // dd($productNames);
            $productPrices = DB::table('products')->select('price')->whereIn('id',$idList)->get();
            // dd($productPrices);
            // 443.47,724.49,335.02,317.89
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
