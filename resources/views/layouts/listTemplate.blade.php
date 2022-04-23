
<x-app-layout>
    <x-slot name="header"> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <!-- To add a variable or string into the {} we have to put the yield sign outside, otherwise there will be some errors -->
            @yield('name'){{ __(" List") }}
        </h2>
    </x-slot> 
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div  class="p-6 bg-white border-b border-gray-200">
                        <div style="display:flex;justify-content: space-evenly;align-items: center;">
                            @yield('searchBar')
                            @yield('addButton')
                        </div>
                        <br>
                        <br>
                        <table style="width:100%;">
                            <tr>
                                <!-- By using the same yield name (X in this case) we can repeat the same value in diferent places -->
                                <th>@yield('X') NAME</th>
                                <th>@yield('X') ID</th>
                                @yield('Titles')
                                <th>EDIT</th>
                                <th>DELETE</th>
                            </tr>
                            <!-- <span class="name"></span><span style="padding-left:300px;" class="category"></span><span style="float:right" class="price"></span> -->

                            <!-- to add a full foreach we can't do it throught the yield method so just save that space and put it in the view itself -->
                            @yield('infoTable')
                            
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
       


</x-app-layout>