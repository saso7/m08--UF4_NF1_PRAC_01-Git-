@include('layouts.userHeaderTemplate')
@extends('layouts.userMainTemplate')
@section('productsList')
<div class="televisionList">
    @foreach($products as $product)
        <a href="{{ route('productDetail', ['product' => $product]) }}">
            <img  class="TvList" src="{{ Storage::url($product->file_path) }}" alt="{{$product->name}}"></img>
        </a>
    @endforeach
</div>
@stop
