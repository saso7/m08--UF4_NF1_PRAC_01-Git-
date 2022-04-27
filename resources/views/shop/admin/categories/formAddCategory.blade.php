@extends('layouts.adminHeaderTemplate')   
@section('form')           
    <form action="{{route('adding_category')}}" method="POST" style="text-align:center" enctype="multipart/form-data">
        @csrf
        <div class="add-prod-box">
            <label for="name">Name</label>
            <br>
            <br>
            <input type="text" id="name" name="name" required
                minlength="4" maxlength="15" size="10">
            @error('name')<div class="alert alert-danger">{{ $message }}</div>@enderror
        </div>
        <br>
        <br>
        <div style="cursor: pointer;display:flex;justify-content: center;">
            <div style="width:150px;text-align:center;display:grid;justify-items: center;">
                <div style="display:grid;border:black solid 1px;align-items: center;width:100px;height:50px;">
                    <a href="{{route('categories')}}">
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