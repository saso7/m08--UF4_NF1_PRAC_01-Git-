@include('layouts.userHeaderTemplate')
@extends('layouts.userMainTemplate')
@section('productsList')
<div style="display:flex;justify-content: space-around;flex-direction: row; align-items: center;">
        @foreach($products as $product)
        <a style="text-decoration:none;text-align:center;" href="{{ route('productDetail', ['product' => $product]) }}">
            <img  class="catList" src="{{ Storage::url($product->file_path) }}" alt="{{$product->name}}"></img>
            <p >{{$product->name}}</p>
        </a>
        @endforeach
    </div>
@stop