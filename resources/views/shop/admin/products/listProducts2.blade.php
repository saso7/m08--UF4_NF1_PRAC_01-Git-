

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Products List") }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div  class="p-6 bg-white border-b border-gray-200">
                    <table style="width:100%;">
                        <tr>
                            <th>PRODUCT'S NAME</th>
                            <th>PRODUCT'S ID</th>
                            <th>PRODUCT'S PRICE</th>
                            <th>PRODUCT'S AMOUNT</th>
                        </tr>
                        <!-- <span class="name"></span><span style="padding-left:300px;" class="category"></span><span style="float:right" class="price"></span> -->

                    @foreach($products as $product)
                        <tr style="text-align:center;" >
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category_id}}</td>
                            <td>{{ $product->price }}€</td>
                            <td>{{ $product->amount }}</td>
                        <!-- <div class="product" >
                            <span style="text-align:center;"class="name">{{ $product->name }}</span><span style="padding-left:300px;" class="category">{{$product->category_id}}</span><span style="float:right" class="price">{{ $product->price }}€</span>
                        </div> -->
                        </tr>
                    
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 style="text-align:center">Add new product</h2>
                    <form action="{{route('add_product')}}" method="POST" style="text-align:center">
                        @csrf
                        <div class="add-prod-box">
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" required
                                minlength="4" maxlength="15" size="10">
                        </div>
                        <br>
                        <br>
                        <div class="add-prod-box">
                            <label for="name">Price:</label>
                            <input type="number" id="price" name="price" required
                                minlength="1" maxlength="8" size="10">
                        </div>
                        <br>
                        <br>
                        <div class="add-prod-box">
                            <label for="name">Amount:</label>
                            <input type="number" id="amount" name="amount" required
                                minlength="1" maxlength="8" size="10">
                        </div>
                        <br>
                        <br>
                        <div class="add-prod-box">
                            <label for="name">Category:</label>
                            <select id="category" name="category" required>
                                @foreach($categories as $category)
                                <option value = {{ $category->id}} >{{ $category->id}}</option>
                                @endforeach
                                <!-- <option value = 1 >Category 1</option>
                                <option value = 2 >Category 2</option>
                                <option value = 3 >Category 3</option> -->
                            </select>
                        </div>
                        <br>

                        <input type="submit" value="Send">
                    </form> 
                </div>
            </div>
        </div>
    </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 style="text-align:center">Edit a product</h2>
                    <form action="{{route('edit_product')}}" method="POST" style="text-align:center">
                        @csrf
                        <div>
                            <label for="name">Name:</label>
                            <select id="name" name="name" required>
                                @foreach($products as $product)
                                    <option value = "{{$product->name}}" >{{$product->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <br>
                        <div>
                            <label for="name">What do you want to change?</label>
                            <br>
                            <select id="change" name="change" required>
                                <option value = 'nothing' selected="selected">Nothing</option>
                                <option value = 'name' >Name</option>
                                <option value = 'price'>Price</option>
                                <option value = 'amount'>Amount</option>
                                <option value = 'category'>Category</option>
                            </select>
                        </div>
                        <br>
                        <br>
                        <!-- <div>
                            <label for="name">another input:</label>
                            <input type="text" id="un" name="un" required
                                minlength="1" maxlength="8" size="10">
                        </div> -->


                        <div id="selection">
                        </div>
                        <input type="submit" value="Edit">
                    </form> 

                </div>
            </div>
        </div>
    </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 style="text-align:center">Delete products</h2>
                    <form action="{{route('delete_product')}}" method="POST" style="text-align:center">
                        @csrf
                        <div>
                            <label for="name">Which product do you want to delete?</label>
                            <br>
                            <select id="name" name="name" required>
                                @foreach($products as $product)
                                    <option value = "{{$product->name}}" >{{$product->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="submit" value="Delete">
                    </form> 

                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    var election = document.getElementById("change");
    console.log("the election is:");
    console.log(election);
    /* In order to be able to cancel the event listener once we use it already once we have to use the handler 
    as a variable to reference in the eventlistener.*/
    var handler = function(e){
        console.log(e.target.value);
        if(e.target.value == "category"){
            let divToFill = document.getElementById("selection");
            let select = document.createElement("select");
            select.name = "categoria";
            for(var i=1;i<=4;i++){
                let option = document.createElement("option");
                option.value = i;
                option.innerHTML = i;
                select.appendChild(option)
            }
            divToFill.appendChild(select);
        }
        else{
            let divToFill = document.getElementById("selection");
            let div = document.createElement("div");
            let input = document.createElement("input");
            console.log(input);
            input.name = "numberOrText";
            if(e.target.value == "price"){
                input.setAttribute("type","number");
            }
            else{
                input.setAttribute("type","text");
            }
            console.log(div);
            div.appendChild(input);
            divToFill.appendChild(div);
        }

        // So after all the event we just erease it from the element so it can't create another one.
        election.removeEventListener("change",handler);
    }
    election.addEventListener("change",handler);
    
    
</script>
</x-app-layout>