@extends('layouts.listTemplate')
    @section('name','Products')
    @section('searchBar')
        <form class="input-group" action="{{route('products')}}" method="GET">
            <input type="text" class="form-control" name="search" value="{{request()->query('search')}}" placeholder="Search">
            <div class="input-group-addon">
                <span class="input-group-text"><i class="ti-search"></i></span>
            </div>
        </form>
    @stop
    @section('addButton')
        <!-- <div class="input-group">
            <a href="{{route('products.create', ['products' => $products])}}">
                <button class="buton">Add another Category</button>
            </a>
        </div> -->
        <div class="input-group">
            <a href="{{route('products.create')}}">
                <button class="buton">Add another Product</button>
            </a>
        </div>
    @stop
<!-- We only need to use once this X name and it will fill all the X in the listTemplate -->
    @section('X','PRODUCT\'S')
    @section('Titles')
        <th>PRODUCT\'S PRICE</th>
        <th>PRODUCT\'S AMOUNT</th>
    @stop

    @section('infoTable')

        @foreach($products as $product)
            <tr style="text-align:center;" >
                <td>{{ $product->name }}</td>
                <td>{{ $product->category_id}}</td>
                <td>{{ $product->price }}€</td>
                <td>{{ $product->amount }}</td>
                <td >
                    <img class="colEdit">
                        <a href="{{ route('form.edit.products', ['product' => $product]) }}">
                            <button type="submit" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
                            </button>
                        </a>
                    </img>
                </td>
                <td >
                    <img class="colDelete">

                        <form action="{{route('delete_product', ['product' => $product]) }}" method="POST" style="text-align:center">
                            @csrf
                            <button type="submit" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </button>
                        </form>

                    </img>
                </td>
            </tr>
        @endforeach
        <!-- This is to show a message in case there's no products for the request -->
        @forelse($products as $product)
            @empty
            <p class="text-center">
                No results found for query <strong>{{request()->query('search')}}</strong>
            </p>
        @endforelse
    @stop
