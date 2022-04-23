<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/userMainStyle.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
    @yield('offers')

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