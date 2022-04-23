@extends('layouts.adminHeaderTemplate')   
@section('form')           
    <form action="{{route('add_product')}}" method="POST" enctype="multipart/form-data" style="text-align:center">
        @csrf
        <div class="add-prod-box">
            <label for="name">Name</label>
            <br>
            <input type="text" id="name" name="name" required
                minlength="4" maxlength="15" size="20">
        </div>
        <br>
        <div class="add-prod-box">
            <label for="name">Price</label>
            <br>
            <input type="number" id="price" name="price" required
                minlength="4" maxlength="15" size="10">
        </div>
        <br>
        <div class="add-prod-box">
            <label for="name">Amount</label>
            <br>
            <input type="number" id="amount" name="amount" required
                minlength="4" maxlength="15" size="10">
        </div>
        <br>

        <!-- Crec que aquesta part s'ha d'autogenerar... -->
        <!-- <div class="add-prod-box">
            <label for="name">File Name</label>
            <br>
            <input type="text" id="file_name" name="file_name" required
                minlength="4" maxlength="255" size="20">
        </div>
        <br> -->


        <div class="add-prod-box">
            <label for="name">Description</label>
            <br>
            <input type="text" id="description" style="height:70px" name="description" required
                minlength="10" maxlength="255" size="70">
        </div>
        <br>

            <label for="name">Category Id</label>
            <br>
            <div>
                <select name="category_id" id="category_id">
                    @foreach($productsId as $productId)
                        <option  value="{{ $productId }}">{{ $productId }}</option>
                    @endforeach
                </select>
            </div>
        <br>
        <div>
            <label> Upload Image </label>
            <input type="file" name="file_name" >
        </div>
        <br>


        <div style="cursor: pointer;display:flex;justify-content: center;">
            <div style="width:150px;text-align:center;display:grid;justify-items: center;">
                <div style="display:grid;border:black solid 1px;align-items: center;width:100px;height:50px;">
                    <a href="">
                        <input style="cursor:pointer;" type="submit" value="Send">
                    </a>
                </div>
            </div>
        </div>
        <br>
    </form> 
        <div style="cursor: pointer;text-align:center;display:grid;justify-items: center;">
            <div style="display:grid;border:black solid 1px;align-items: center;width:100px;height:50px;">
                <a href="{{route('products')}}">
                    <button >Back</button>
                </a>
            </div>
        </div>
    <br>


    
@endsection        
<!-- <div class="add-prod-box">
    <label for="name">Category Id</label>
    <br>
    <input type="number" id="category_id" name="category_id" required
        minlength="4" maxlength="15" size="10">
</div> -->