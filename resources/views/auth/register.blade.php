@extends('layouts.app')

@section('title',"Register")

@section("style")
<link href="{{ asset('css/signup.css') }}" rel="stylesheet">
@endsection


@section('script')
<script src="{{asset('js/signup.js')}}" defer="true"></script>
@endsection


@section('main')
<div class = 'tasti' >
                <span id = 'tastoLog' class='overlay' > <a href= '{{route("login")}}'> Login</a> </span> 
                <span id = 'tastoSubscribe' > Subscribe</span>
            </div>
        
            <div class = 'campo'>
            
            <form id = "Iscrizione"  action = '{{route("register")}}' method = 'POST' enctype="multipart/form-data">
                @csrf
                <p>
                <label>Nome <input type='text' name='name' value='{{old("name")}}'></label>
                </p>
                <p>
                <label>Cognome <input type='text' name='surname' value='{{old("surname")}}'></label>
                </p>
                <p>  
                    <p>
                        <label class="signup">Email <input type='text' name='email' value='{{old("email")}}'></label>
                        </p>
                        <p>
                        <label id='nomeUtente' class="signup">Nome_Utente <input type='text' name='username' value='{{old("username")}}' verifyUsername='{{route("controlUsername")}}'>
                        </label>
                        </p>
                        <p>
                            <label>Password<input type='password' name='password'></label>
                            </p>
                            <p>
                                <label>Conferma Password<input type='password' name='password_confirmation'></label>
                                </p>
                                <p>
                                <label >Immagine del profilo(URL) <input type="file" name='photo' accept="images/*"></label>
                                </p>
                            <p class='TastoInvio'>
                         <label>&nbsp;<input type='submit' value="Registrati"></label>
                             </p>
                </form> 
            <span id = "Errore" >
            @error('name')
            {{$message}}
            @enderror
            @error('surname')
            {{$message}}
            @enderror
            @error('photo')
            {{$message}}
            @enderror
            </span>
            <span id = "ErrorePassword" >
            @error('password')
            {{$message}}
            @enderror
            </span>
            <span id = "ErroreMail" >
            @error('email')
            {{$message}}
            @enderror
            </span>
            <span id ="ErroreNomeUtente">
            </span>
            </div>
@endsection
