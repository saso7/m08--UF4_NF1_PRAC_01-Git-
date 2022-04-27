@include('layouts.userHeaderTemplate')
<div style="text-align:center;display:grid;justify-items: center;">
    @if(!empty($idList))
        <label>Basket's total price</label>
        <div>{{$orders->total_price}}</div>
        <br>

        @for ($i = 0; $i <$length; $i++)
        
            
            <label>Product Name</label>
            <div>{{$productNames[$i]->name}}</div>
            <label>Price per product</label>
            <div>{{$productPrices[$i]->price}}€</div>
            <label>Price total product </label>
            <div>{{$listOfPrices[$i]}}€</div>
            <label>Product Quantity</label>
            <div style="width:200px;display:grid;grid-template-columns: 33% 33% 33%;">
                <a href="{{ route('minusOne',['orderId'=>$ordersItems[$i]->id,'priceProduct'=>$productPrices[$i]->price,'totalPrice'=>$orders->total_price,'productId'=>$ordersItems[$i]->product_id,'subOrderId'=>$ordersItems[$i]->order_id]) }}">
                    <button type="submit" <?php if ($disable[$i] == true){ ?> disabled <?php   } ?>>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"/>
                        </svg>
                    </button> 
                </a>
                <div>{{$ordersItems[$i]->quantity}}</div>
                <a href="{{ route('plusOne',['orderId'=>$ordersItems[$i]->id,'priceProduct'=>$productPrices[$i]->price,'totalPrice'=>$orders->total_price,'productId'=>$ordersItems[$i]->product_id,'subOrderId'=>$ordersItems[$i]->order_id])  }}">
                    <button type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                        </svg>
                    </button>
                </a>
            </div>
            <div style="display:grid;">
                    <a href="{{ route('delete_subOrder', ['subOrderId'=>$ordersItems[$i]->id,'priceOfSubOrder'=>$listOfPrices[$i],]) }}" method="POST" style="text-align:center">
                        <button type="submit" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                        </button>
                    </a>
                </div>
            <div></div>
            <br>
            <br>

        @endfor
        <a href="{{ route('buy',['orderId' => $orders->getOriginal('id')]) }}">
            <button class="basket">Complete the order</button>
        </a>
        <a href="{{ route('dashboard') }}">
            <button class="basket">Back to main</button>
        </a>
    @else
        <div style="font-size: 150%;font-weight:bold;margin-top:50px;">There's nothing in your basket, go and buy something ;)</div>
        <a href="{{ route('dashboard') }}">
            <button class="basket">Back to main</button>
        </a>
    @endif
    
</div>