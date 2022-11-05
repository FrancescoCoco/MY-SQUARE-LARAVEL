@extends('layouts.app')

@section("style")
<link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endsection

@section('title',"Login")

@section('main')
<div class = 'tasti' >
                <span id = 'tastoLog' > Login</span> 
                <span id = 'tastoSubscribe' class='overlay'> <a href='{{route("register")}}'> Subscribe </a> </span>
</div> 
            <div class = 'campo'>
            <form id = "LogIn" action = '{{route("login")}}' method = 'POST'>
                    @csrf   
                        <p>
                        <label>Nome_Utente <input type='text' name='username' value='{{old("username")}}'></label>
                        </p>

                        <p>
                            <label>Password<input type='password' name='password'></label>
                        </p>
                        
                        <p class = 'Ricordami'>
                            <label>Ricordami<input type='checkbox' name='remember'></label>
                        </p>
                        <p class= "TastoAccedi">  
                             <label>&nbsp;<input type='submit'value= "Accedi"></label>
                        </p>

            </form> 
            <span id = "Errore" >
            @error('username')
            {{$message}}
            @enderror
            </span>
            </div>
@endsection