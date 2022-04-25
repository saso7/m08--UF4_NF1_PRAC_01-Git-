<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/userHeaderStyle.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
</head>
<body>
    <div class="header-separator">
        <div class="header-main">
            <div class="header-logo">
                <a href="{{ route('dashboard') }}">
                    <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                </a>
            </div>
                <div class="drop-down-box">
                    <!-- At the moment we will leave it as onclick but in the future probably will be swap to onmouseover and onmouseout -->
                    <button  onclick="show()"  id="drop-down-button" class="drop-down-button">
                        <div class="drop-down-wrapped-svg">
                            <svg class="svg-stuff" viewBox="0 0 80 80">
                                <path d="M4.726 9.507c-2.66 0-4.56 2.279-4.56 4.938s2.28 4.56 4.94 4.56h70.283c2.66 0 4.56-1.9 4.56-4.56s-1.9-4.938-4.56-4.938H4.726zm0 25.834c-2.66 0-4.56 1.9-4.56 4.559s2.28 4.559 4.94 4.559h70.283c2.66 0 4.56-1.9 4.56-4.56s-1.9-4.558-4.56-4.558H4.726zm0 25.454c-2.66 0-4.94 2.28-4.94 4.939s2.28 4.559 4.94 4.559H75.01c2.659 0 4.938-2.28 4.938-4.94s-2.28-4.938-4.938-4.938H4.726v.38z"></path>
                            </svg>
                        </div>
                        <span class="drop-down-product-title">Products</span>
                    </button>
                    <div id="dropDown"style="display:none;">
                    @foreach($categories as $category)
                        <a style="width:100%" href="{{ route('categoryView', ['categoryName' => $category->name]) }}">
                            <div id="categoryName" style="display:none;"value = "{{$category->name}}" >{{$category->name}}</div>
                        </a>
                    @endforeach
                    </div>
                </div>
                <div style="display:grid;align-items: center;justify-items: center;">
                    <form class="input-group" action="{{route('products')}}" method="GET">
                        <input type="text" class="form-control" name="search" value="{{request()->query('search')}}" placeholder="Search">
                        <div class="input-group-addon">
                            <span class="input-group-text"><i class="ti-search"></i></span>
                        </div>
                    </form>
                </div>
            <div class="header-session">
            @if (Route::has('login'))
                    @auth
                        <!-- Authentication -->
                        <div style="color:white;">{{ Auth::user()->name }}</div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" style="color:white;text-decoration:none"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                        <div class="header-basket">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="blue" class="bi bi-cart4" viewBox="0 0 16 16">
                                <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                            </svg>
                            <a style="text-decoration:none" href="{{ route('basket') }}" class="header-links">Basket</a>
                        </div>
                    @else
                        <div class="header-login">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="blue" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            </svg>
                            <a href="{{ route('login') }}" class="header-links">Log in</a>
                        </div>
                        

                        @if (Route::has('register'))
                        <div class="header-register">
                            <svg xmlns="http://www.w3.org/2000/svg"  width="27" height="27" fill="blue" class="bi bi-pen" viewBox="0 0 16 16">
                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                            </svg>
                            <a href="{{ route('register') }}" class="header-links">Register</a>
                        </div> 
                        @endif

                    @endauth

            @endif
            </div>
        </div>
    </div>

    <script type="text/javascript">

        function show(categories){
            var categories = document.querySelectorAll("#categoryName");
            var listCategories = document.querySelector("#dropDown");
            for(let category of categories){
                category.setAttribute("style","padding-top:10px;background: linear-gradient(red, rgb(72, 2, 2));display:block;width:100%;height:35px;text-align:center;margin:0px auto;")
            }
            listCategories.setAttribute("style","display:flex;")


            var button = document.querySelector("#drop-down-button");
            // button.onclick="hide()";
            button.setAttribute('onclick',hide);
        }
        function hide(){
            var categories = document.querySelectorAll("#categoryName");
            for(let category of categories){
                category.setAttribute("style","display:none")
            }
        }
    </script>

</body>
</html>
