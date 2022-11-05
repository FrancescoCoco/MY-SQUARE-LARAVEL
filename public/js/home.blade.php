<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | Home MySquare  </title>

    <!-- Style -->
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">

    <!-- Scripts 
    <script src="{{asset('js/home.js')}}" defer="true"></script>
    --> 
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Roboto|Source+Sans+Pro&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&display=swap" rel="stylesheet"> 


</head>
<body>
    <nav id = "barra">
        <nav id= "menu">
        <div id="menuBar"> 
          <div></div>
          <div></div>
          <div></div>
        </div>
        <a href="{{ route('home') }}" id="Logo">MYSQ</a>
        <a href="search_people.php" class = "Boxes" id = "searchPeople">Cerca Persone</a>
        <a href="{{ route('home') }}"class = "Boxes" id = "home">Home</a>
        <a href="search_content.php" class = "Boxes" id = "searchContent">Cerca Post</a>
        <a class="Boxes" id = "logout" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
        </nav>
        
        <!--
        <nav id= "profilo">
        </nav>
        --> 
    </nav>
    <div id= "Posts">
    </div>
    <section id="modal-view" class="hidden">
    </section>
    </body>
</html>
