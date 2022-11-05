<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use Illuminate\Http\Request;

class SearchPeopleController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $username= $user->username;
        $userphoto= DB::table('users')->select("photo")->where('username',"=","$username")->first();
        if($userphoto->photo===null){
            $photo= "http://151.97.9.184/coco_francescomaria/HW2/public/images/default.jpg";
        }
        else {
        $photo = "http://151.97.9.184/coco_francescomaria/hw2/storage/app/public/".$userphoto->photo;
        }
        return view('searchPeople',[
            "nomeUtente" => $user->username,
            "avatar" => $photo
        ]);
    }

    public function restituisciUtenti(){
        $utenti= array();
        $userLogin = Auth::user();
        $username= $userLogin->username;
        $users=DB::table("users")->where('username',"!=","$username")->get();
        foreach($users as $user){
            $seguito = $user->username;
            $row= DB::table("hw2followers")->where('user_follower',"=","$username")->where('user_followed',"=","$seguito")->first();
            if(!$row){
                $infoFollow = [
                    'seguito' => $seguito,
                    'isfollow' => '0'
                  ];
            }
            else {
                $infoFollow = [
                    'seguito' => $seguito,
                    'isfollow' => '1'
                  ];
            }
            $utente=[
                'nome' => $user->name,
                'cognome' =>$user->surname,
                'nomeUtente' =>$user->username,
                'avatar' =>$user->photo,
                'email' => $user->email
            ];
            $utentiInfo= $utente + $infoFollow;
            $utenti[]= $utentiInfo;
        }
        return response()->json($utenti);
    }
    
    public function FollowPeople(){
        $request= request();
        $user = Auth::user();
        $username= $user->username;
        $user_followed= $request->userfollowed;
        $users=DB::insert("INSERT INTO hw2followers(user_follower,user_followed) VALUES('$username','$user_followed')");
        return response("Segui_già");
    }
    
    public function DisfollowPeople(){
        $request= request();
        $user = Auth::user();
        $username= $user->username;
        $user_unfollowed= $request->userunfollowed;
        $users=DB::table("hw2followers")->where('user_follower','=',"$username")->where("user_followed",'=',"$user_unfollowed")->delete();
        return response("Segui");
    }
    public function SeeUser(){
        $request= request();
        $username= $request->cliccato;
        $user=DB::table("users")->where('username','=',"$username")->first();
        $contoseguiti = DB::table('hw2followers')->select(DB::raw('count(user_followed) as seguiti'))->where('user_follower',"=","$username")->first();
        $seguiti= $contoseguiti->seguiti;
        $contoseguaci= DB::table('hw2followers')->select(DB::raw('count(user_follower) as seguaci'))->where('user_followed','=',"$username")->first();
        $seguaci= $contoseguaci->seguaci;
        $utente=[
            "nome"=>$user->name,
            "cognome"=>$user->surname,
            "nomeUtente" => $username,
            "email" => $user->email,
            "avatar" => $user->photo,
            "seguiti" => $seguiti,
            "seguaci" => $seguaci
        ];
        $utenti[]=$utente;
        return response()->json($utenti);
    }

    public function DoSearchPeople(){
        $request= request();
        $utenti= array();
        $log = Auth::user();
        $username= $log->username;
        $testo= $request->testo;
        $users = DB::table('users')->where('username',"LIKE","%"."$testo"."%")->get();
        foreach($users as $user){
            if($user->username!==$username){
            $seguito = $user->username;
            $row= DB::table("hw2followers")->where('user_follower',"=","$username")->where('user_followed',"=","$seguito")->first();
            if(!$row){
                $infoFollow = [
                    'seguito' => $seguito,
                    'isfollow' => '0'
                  ];
            }
            else {
                $infoFollow = [
                    'seguito' => $seguito,
                    'isfollow' => '1'
                  ];
            }
            $utente=[
                'nome' => $user->name,
                'cognome' =>$user->surname,
                'nomeUtente' =>$user->username,
                'avatar' =>$user->photo,
                'email' => $user->email
            ];
            $utentiInfo= $utente + $infoFollow;
            $utenti[]= $utentiInfo;
        }
    }
        return response()->json($utenti);
    }
}
