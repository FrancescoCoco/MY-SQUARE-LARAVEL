<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield("title")  </title>

    <!-- Scripts -->
    @yield("script")

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Roboto|Source+Sans+Pro&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&display=swap" rel="stylesheet"> 

    <!-- Styles -->
    @yield("style")

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
         <a href="{{ route('searchPeople') }}" class="Boxes" id = "searchPeople">Cerca Persone</a> 
        <a href="{{ route('home') }}"class = "Boxes" id = "home">Home</a>
         <a href="{{ route('searchContent') }}" class = "Boxes" id = "searchContent">Cerca Contenuto</a> 
        <a class="Boxes" id = "logout" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
        </nav>
        <nav id= "profilo">
        @yield("infoHome")
        <span id='nomeUtente'><?php echo($nomeUtente)?></span>
        <span id="avatar"><?php echo("<img src='$avatar'>")?></span>
        </nav>
    </nav>

    @yield("content")
    <section id="modal-view" class="hidden"></section>
        <section id="modal_cell" class="hidden"> 
            <div class="chiusura">
                <img class="imageChiusura" 
                src="{{asset('images/chiusura.jpg')}}">
            </div>
            <div class="contenuto">
                <div class="contenutoLink">
                    <a href="{{ route('searchPeople') }}">Search_People</a>
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('searchContent') }}">Search_Content</a>
                    <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                </div>
            </div>
        </section>
    
    </body>
    </html>

