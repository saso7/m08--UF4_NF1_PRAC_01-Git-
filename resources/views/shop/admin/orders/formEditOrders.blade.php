@extends('layouts.adminHeaderTemplate')   
@section('form')    
           
    <form action="{{route('editing_order')}}" method="POST" style="text-align:center" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">This is the 'ID' from the actual Order you gonna change:</label>
            <br>

            <select id="id" name="id" required>
                    <option value = "{{$order[0]->id}}" >{{$order[0]->id}}</option>
            </select>
        </div>
        <div>
            <label for="name">This is the 'status' now:</label>
            <br>

            <select id="status" name="status" required>
                    <option value = "{{$order[0]->status}}" >{{$order[0]->status}}</option>
            </select>
            
        </div>
        <br>
        <br>
        <div>
            <label for="name">New Status:</label>
            <br>
            <select name="newStatus" id="newStatus">
                <option value="pending">pending</option>
                <option value="completed">completed</option>
                <option value="delivered">delivered</option>
            </select>
            @error('newStatus')<div class="alert alert-danger">{{ $message }}</div>@enderror
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
                <a href="{{route('orders')}}">
                    <button >Back</button>
                </a>
            </div>
        </div>
@endsection