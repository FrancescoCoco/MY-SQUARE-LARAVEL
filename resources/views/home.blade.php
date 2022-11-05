    @extends('layouts.content')
    @section('title',"Home"." "."$nomeUtente")

    @section('script')
    <script src="{{asset('js/home.js')}}" defer="true"></script>
    <script type="text/javascript" defer> 
    const UtentiLikes= '{{route("UtentiLikes")}}'
    const ChiusuraImage="{{asset('images/chiusura.jpg')}}"
        const TogliLike= '{{route("TogliLike")}}'
        const storage= "http://151.97.9.184/coco_francescomaria/hw2/storage/app/public"
        const defaultImage= "{{asset('images/default.jpg')}}"
        const AggiungiLike= '{{route("AggiungiLike")}}'
        const UtenteInfo= '{{route("UtenteInfo")}}'
        const UtentiSeguiti= '{{route("UtentiSeguiti")}}'
        const seguiti= '{{route("seguiti")}}'
        const seguaci= '{{route("seguaci")}}'
        </script>
    @endsection

    <!-- Style -->
    @section('style')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    @endsection

        @section('infoHome')
        <?php
        echo "<span class= 'boxInfoUtenteNav'>";
         if($seguiti!==NULL)
         {   
             echo "<span id='seguiti'>";
             echo "Seguiti: "."$seguiti";
             echo "</span>";
         }
         if($seguaci!==NULL)
         {   
             echo "<span id='seguaci'>";
             echo "Follower: "."$seguaci";
             echo "</span>";
         }
         echo "</span>"
          ?>
        @endsection

        @section("content")
    <div id= "Posts">
    </div>
    @endsection
   

