@extends('layouts.productDetailTemplate')
@section('productImageText')

    <img class="image" src="{{ Storage::url($product[0]->file_path) }}"></img>
    <div class="text" value="{{$product[0]->description}}">{{$product[0]->description}}</div>
@stop
@section('productPriceButtonBasket')
    <form action="{{ route('addtobasket', ['productId' => $product[0]->id]) }}" method="POST" style="text-align:center" enctype="multipart/form-data">
        @csrf
        <input size='7px;' class="price" name="price" value="{{$product[0]->price}}" readonly/>€ each unity
        <br>
        <input size='7px;' class="quantity" name="quantity" type="number" value="1" style="text-align:right;"></input>
        <!-- <a href="{{ route('addtobasket', ['productId' => $product[0]->id]) }}">
            <button class="basket">Add to basket</button>
        </a> -->
        <br>
        <input type="submit" value="Add to basket">
    </form>
    <a href="{{ route('televisions') }}">
        <button class="basket">Back</button>
    </a>
@stop
@extends('layouts.userHeaderTemplate')