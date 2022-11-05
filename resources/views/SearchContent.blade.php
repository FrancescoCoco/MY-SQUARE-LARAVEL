    @extends('layouts.content')
    @section('title',"SearchContent"." "."$nomeUtente")

    <!-- Style -->
    @section('style')
    <link href="{{ asset('css/search_content.css') }}" rel="stylesheet">
    @endsection


    @section('script')
    <script type="text/javascript" defer> 
    const SharePost= '{{route("SharePost")}}'
    const ChiusuraImage="{{asset('images/chiusura.jpg')}}"
    </script>
    <script src="{{asset('js/search_content.js')}}" defer="true"></script>
    @endsection


    @section("content")
    <div id ="ResearchResult">
        <span id = "RicercaContenutiBox">
        <h1 id ="Logo"> MY SQUARE </h1>
        <form id ="RicercaContenuto" doSearchContent ='{{route("DoSearchContent")}}' method = 'POST' enctype="multipart/form-data">
        @csrf 
        <label><input type="search" placeholder="Cerca un contenuto su" name='posts'></label>
        <select class = "selezione" name ='opzione'>
        <option value="spotify">Spotify</option>
        <option value="GifAnimate" >GifAnimate</option>   
        </select>
        <label>&nbsp;<input type='submit' value='Cerca'></label>
        </form>
        </span>
        <div id = "boxPosts">
        </div>
        </div>
    
    @endsection
   

