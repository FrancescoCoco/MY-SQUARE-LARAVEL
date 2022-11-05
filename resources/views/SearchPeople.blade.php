    @extends('layouts.content')
    @section('title',"SearchPeople"." "."$nomeUtente")

    @section('script')
    <script src="{{asset('js/search_people.js')}}" defer="true"></script>
    <script type="text/javascript" defer> 
    const FollowPeople= '{{route("FollowPeople")}}'
    const DisfollowPeople= '{{route("DisfollowPeople")}}'
    const ChiusuraImage="{{asset('images/chiusura.jpg')}}"
    const storage= "http://151.97.9.184/coco_francescomaria/hw2/storage/app/public"
    const defaultImage= "{{asset('images/default.jpg')}}"
    const SeeUser= '{{route("SeeUser")}}'
    </script>
    @endsection

    <!-- Style -->
    @section('style')
    <link href="{{ asset('css/search_people.css') }}" rel="stylesheet">
    @endsection
    @section("content")
    <div class='hidden' id="restituisciUtenti" restituisciUtenti="{{ route('restituisciUtenti') }}"></div>
    <div id ="ResearchResult">
        <span id = "RicercaUtenteBox">
        <h1 id ="Logo"> MY SQUARE </h1>
        <form id ="RicercaUtente" method='GET' action='{{route("DoSearchPeople")}}'>
        <label><input type="search" placeholder="Cerca un utente" name='utenti'></label>
        <label>&nbsp;<input type='submit' value='Cerca'></label>
        </form>
        </span>
        <div id = "boxUtenti">
        </div>
        </div>
    @endsection
   

