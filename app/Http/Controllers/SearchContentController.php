<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use Illuminate\Http\Request;

class SearchContentController extends Controller
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
        return view('searchContent',[
            "nomeUtente" => $user->username,
            "avatar" => $photo
        ]);
    }

    public function DoSearchContent(){
        $request= request();
        $testo= $request->send;
        $opzione= $request->opzione;
        if($opzione==="spotify"){
        $client_id = env("SPOTIFY_CLIENT_ID");
        $client_secret = env("SPOTIFY_CLIENT_SECRET");
        $curl = curl_init();
   curl_setopt($curl, CURLOPT_URL, "https://accounts.spotify.com/api/token");
   curl_setopt($curl, CURLOPT_POST, 1);
   curl_setopt($curl, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
   $headers = array("Authorization: Basic ".base64_encode($client_id.":".$client_secret));
   curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   $result = curl_exec($curl);
   curl_close($curl);
   $token = json_decode($result)->access_token;
   $data = http_build_query(array("q" => $testo, "type" => "album"));
   $curl = curl_init();
   curl_setopt($curl, CURLOPT_URL, "https://api.spotify.com/v1/search?".$data);
   $headers = array("Authorization: Bearer ".$token);
   curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   $result = curl_exec($curl);
   echo $result;
   curl_close($curl);
   }

   else{
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, "http://api.giphy.com/v1/gifs/search?q=".urlencode($testo)."&api_key=TrtuAq0z8mPxO6XH9rFLMkmbSgqcVxRv");
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     $api_return = curl_exec($ch);
     echo $api_return;
     curl_close($ch);
   }
    }

    public function SharePost(){
        $user = Auth::user();
        $username= $user->username;
        $request=  request();
        $url = $request->image;
        $titolo= $request->titolo;
        $datacorrente= date('Y-m-d H:i:s');
        $posts=DB::insert("INSERT INTO posts(title,url_img,username,date) VALUES('$titolo','$url','$username','$datacorrente')");
        return response("Inserimento effettuato");
    }

}
