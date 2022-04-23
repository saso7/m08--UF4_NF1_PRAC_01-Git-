@extends('layouts.adminHeaderTemplate')   
@section('form')    
           
    <form action="{{route('editing_product')}}" method="POST" style="text-align:center" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">Your about to change this Category name:</label>
            <br>
            <select id="name" name="name" required>
                    <option value = "{{$products[0]->name}}" >{{$products[0]->name}}</option>
            </select>
        </div>
        <br>

        <div>

            <label for="name">New Product's Name:</label>
            <br>
            <input name = "newName" type="text" value="{{$products[0]->name}}"/>
            <br>


            <label for="name">New Product's Category Id:</label>
            <br>
            <input name = "newCategoryId" type="text" value="{{$products[0]->category_id}}"/>
            <br>

            
            <label for="name">New Product's Price:</label>
            <br>
            <input name = "newPrice" type="text" value="{{$products[0]->price}}"/>
            <br>


            <label for="name">New Product's amount:</label>
            <br>
            <input name = "newAmount" type="text" value="{{$products[0]->amount}}"/>
            <br>


            <label for="name">Description</label>
            <br>
            <input type="text" id="newDescription" style="height:70px" name="newDescription" value="{{$products[0]->description}}" 
            minlength="10" maxlength="255" size="70">
            <br>
            <br>


            <label> Upload Image </label>
            <input type="file" name="newImage" value="{{$products[0]->file_path}}">
            <br>
        </div>
        <br>
        <div style="cursor: pointer;display:flex;justify-content: center;">
            <div style="width:150px;text-align:center;display:grid;justify-items: center;">
                <div style="display:grid;border:black solid 1px;align-items: center;width:100px;height:50px;">
                    <a href="{{route('products')}}">
                        <input  type="submit" value="Send">
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
@endsection