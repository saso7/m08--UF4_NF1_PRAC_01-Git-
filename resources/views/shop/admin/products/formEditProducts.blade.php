@extends('layouts.adminHeaderTemplate')   
@section('form')    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('editing_product')}}" method="POST" style="text-align:center" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">Your about to change this Product:</label>
            <br>
            <select id="name" name="name" required>
                    <option value = "{{$products[0]->name}}" >{{$products[0]->name}}</option>
            </select>
            @error('name')<div class="alert alert-danger" style="color:red">{{ $message }}</div>@enderror
        </div>
        <br>

        <div>

            <label for="name">New Product's Name:</label>
            <br>
            <input name = "newName" type="text" value="{{$products[0]->name}}"/>
            <br>
            @error('newName')<div class="alert alert-danger" style="color:red">{{ $message }}</div>@enderror

            <label for="name">New Product's Category Id:</label>
            <br>
            <select name="newCategoryId" id="newCategoryId">
                @foreach($categories_id as $category_id)
                    <option  value="{{$category_id->id}}">{{$category_id->id}}</option>
                @endforeach
            </select>
            <br>
            @error('newCategoryId')<div class="alert alert-danger">{{ $message }}</div>@enderror
            
            <label for="name">New Product's Price:</label>
            <br>
            <input name = "newPrice" type="text" value="{{$products[0]->price}}"/>
            <br>
            @error('newPrice')<div class="alert alert-danger">{{ $message }}</div>@enderror

            <label for="name">New Product's amount:</label>
            <br>
            <input name = "newAmount" type="text" value="{{$products[0]->amount}}"/>
            <br>
            @error('newAmount')<div class="alert alert-danger">{{ $message }}</div>@enderror

            <label for="name">Description</label>
            <br>
            <input type="text" id="newDescription" style="height:70px" name="newDescription" value="{{$products[0]->description}}" 
            minlength="10" maxlength="255" size="70">
            @error('newDescription')<div class="alert alert-danger">{{ $message }}</div>@enderror
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
                    <a href="">
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