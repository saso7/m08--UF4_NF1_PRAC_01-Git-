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
           
    <form action="{{route('editing_category')}}" method="POST" style="text-align:center" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">Your about to change this Category name:</label>
            <br>

            <select id="name" name="name" required>
                    <option value = "{{$category[0]->name}}" >{{$category[0]->name}}</option>
            </select>
            @error('name')<div class="alert alert-danger">{{ $message }}</div>@enderror
        </div>
        <br>
        <br>
        <div>
            <label for="name">New Category's Name:</label>
            <br>
            <input maxlength  = "25" name = "newName" type="text"/>
            @error('newName')<div class="alert alert-danger">{{ $message }}</div>@enderror
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
                <a href="{{route('categories')}}">
                    <button >Back</button>
                </a>
            </div>
        </div>
@endsection