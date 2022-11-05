<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
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
        $contoseguiti = DB::table('hw2followers')->select(DB::raw('count(user_followed) as seguiti'))->where('user_follower',"=","$username")->first();
        $seguiti= $contoseguiti->seguiti;
        $contoseguaci= DB::table('hw2followers')->select(DB::raw('count(user_follower) as seguaci'))->where('user_followed','=',"$username")->first();
        $seguaci= $contoseguaci->seguaci;
        return view('home',[
            "nomeUtente" => $user->username,
            "avatar" => $photo,
            "seguiti" => $seguiti,
            "seguaci" => $seguaci
        ]);
    }
    public function UtentiSeguiti(){
        $user = Auth::user();
        $username= $user->username;
        $utenti = array();
        $postInfo= array();
        $usersPosts=DB::select("SELECT DISTINCT p.id as idPost,u.username as nomeUtente,
        u.photo as Imageuser,p.title as titoloPost, p.url_img as ImagePost , p.date as dataPost
        from users u join hw2followers f join posts p on f.user_follower ='$username' AND 
        f.user_followed=p.username and f.user_followed = u.username and p.username = u.username or
        (u.username= '$username' AND p.username= '$username')ORDER BY(p.date)DESC");
        if($usersPosts===NULL){
        $userLog = DB::table("users")->select("username as nomeUtente", "photo as avatar")->where("username","=","$username")->first();
        $infoUtente= [
            'nomeUtente'=>$userLog->nomeUtente,
            'Imageuser'=>$userLog->avatar,
        ];
        $posts = DB::table("posts")->select("id as idPost", "title as titoloPost", "url_img as ImagePost",
        "date as dataPost")->where("username","=","$username")->orderBy("date","DESC")->get();
            foreach($posts as $post){
                $infoPost=[
                    'idPost'=>$post->idPost,
                    'titoloPost'=>$post->titoloPost,
                    'ImagePost'=>$post->imagePost,
                    'dataPost'=>$post->dataPost,
                ];
                $idPost= $post->idPost;
                $like = DB::table("hw2likes")->select("id as idPost", "username as nomeUtente")
                ->where("username","=","$username")->where("id","=","$idPost")->first();
                if($like===NULL){
                    $isLiked=[
                        'isLiked' => '0',
                    ];
                }
                else {
                    $isLiked=[
                        'isLiked' => '1',
                    ];
                }
                
                $numberLikes= DB::table('hw2likes')->join('posts',"hw2likes.id","=","posts.id"
                )->select(DB::raw("count(hw2likes.id) as numeroLikes"))->where("posts.id","=","$idPost")->groupBy("posts.id")->first();
                if($numberLikes===NULL){
                    $numeroLikes= [
                        'numeroLikes'=>'0',
                    ];
                }

                else {
                    $numeroLikes= [
                        'numeroLikes'=> $numberLikes->numeroLikes,
                    ];
                }
                $utenti[]=$infoUtente+$infoPost+$isLiked+$numeroLikes;
            }
            return response()->json($utenti);
        }

        else{
        foreach($usersPosts as $userPost){
            $row = [
                'idPost'=>$userPost->idPost,
                'titoloPost'=>$userPost->titoloPost,
                'nomeUtente'=>$userPost->nomeUtente,
                'Imageuser'=>$userPost->Imageuser,
                'ImagePost'=>$userPost->ImagePost,
                'dataPost'=>$userPost->dataPost,
            ];
            
            $idPost = $userPost->idPost; 
            $like = DB::table("hw2likes")->select("id as idPost", "username as nomeUtente")
            ->where("username","=","$username")->where("id","=","$idPost")->first();
            if($like===NULL){
                    $isLiked=[
                        'isLiked' => '0',
                    ];
                }
                else {
                    $isLiked=[
                        'isLiked' => '1',
                    ];
                }

                $numberLikes= DB::table('hw2likes')->join('posts',"hw2likes.id","=","posts.id"
                )->select(DB::raw("count(hw2likes.id) as numeroLikes"))->where("posts.id","=","$idPost")->groupBy("posts.id")->first();
                
                if($numberLikes===NULL){
                    $numeroLikes= [
                        'numeroLikes'=>'0',
                    ];
                }
                else {
                    $numeroLikes= [
                        'numeroLikes'=> $numberLikes->numeroLikes,
                    ];
                }
                $utenti[]=$row+$isLiked+$numeroLikes;
            }
            return response()->json($utenti);
        }
        }


        public function AggiungiLike(){
        $user = Auth::user();
        $username= $user->username;
        $request= request();
        $post= $request->idPost;
        $inserimento=DB::insert("INSERT INTO hw2likes(id,username) VALUES('$post','$username')");
        $controlloLikes= DB::table('hw2likes')->join('posts',"hw2likes.id","=","posts.id"
        )->select(DB::raw("count(hw2likes.id) as numeroLikes"))->where("posts.id","=","$post")->groupBy("posts.id")->first();
        if($controlloLikes === NULL){
        $response[]= [
                     'numeroLikes' => '0',
                        'idPost' => $post,
                        'isLiked' => '0',
                    ];
        }

        else {
        $response[]= [
        'numeroLikes' => $controlloLikes->numeroLikes,
        'idPost' => $post,
        'isLiked' => '1',
         ];
        }
        return response()->json($response);
                                        }
    
        public function TogliLike(){
            $user = Auth::user();
            $username= $user->username;
            $request= request();
            $post= $request->idPost;
            $users=DB::table("hw2likes")->where('username','=',"$username")->where("id",'=',"$post")->delete();
            $controlloLikes= DB::table('hw2likes')->join('posts',"hw2likes.id","=","posts.id"
                )->select(DB::raw("count(hw2likes.id) as numeroLikes"))->where("posts.id","=","$post")->groupBy("posts.id")->first();
                if($controlloLikes === NULL){
                    $response[]= [
                        'numeroLikes' => '0',
                        'idPost' => $post,
                        'isLiked' => '0',
                    ];
                }

                else {
                    $response[]= [
                        'numeroLikes' => $controlloLikes->numeroLikes,
                        'idPost' => $post,
                        'isLiked' => '1',
                    ];
                }
                return response()->json($response);
        }
        
        public function UtentiLikes(){
            $user = Auth::user();
            $username= $user->username;
            $request= request();
            $post= $request->idPost;
            $utenti = array();
            $utentiLikes= DB::table("hw2likes")->select("id as post", "username as nomeUtente")
            ->where("id","=","$post")->get();      
            foreach($utentiLikes as $row)
                  {
                    $utente= $row->nomeUtente;
                    $infoutente=[
                        'utentiLikes' => $utente,
                        'idPost' => $post,
                    ];
                    $photo= DB::table("users")->select("photo as fotoProfilo")
                    ->where("username","=","$utente")->first();
                      $fotoProfilo=[
                        'fotoProfilo' => $photo->fotoProfilo,
                      ];
                        $info = $fotoProfilo + $infoutente;
                        $utenti[]= $info;
                  }
                  return response()->json($utenti);
                }

        public function seguiti(){
            $utenti=array();
            $user = Auth::user();
            $username= $user->username;
            $seguiti= DB::table("hw2followers")->where("user_follower","=","$username")->get();
            foreach($seguiti as $seguito){
                $photo= DB::table("users")->select("photo as fotoProfilo")
                    ->where("username","=","$seguito->user_followed")->first();
                    $seguitoInfo=[
                        'seguito' => $seguito->user_followed,
                        'seguitoImage' => $photo->fotoProfilo,
                    ];
                    $utenti[]=$seguitoInfo;
            }
            return response()->json($utenti);
        }

        public function seguaci(){
            $utenti=array();
            $user = Auth::user();
            $username= $user->username;
            $seguaci= DB::table("hw2followers")->where("user_followed","=","$username")->get();
            foreach($seguaci as $seguace){
                $photo= DB::table("users")->select("photo as fotoProfilo")
                    ->where("username","=","$seguace->user_follower")->first();
                    $seguaceInfo=[
                        'seguace' => $seguace->user_follower,
                        'seguaceImage' => $photo->fotoProfilo,
                    ];
                    $utenti[]=$seguaceInfo;
            }
            return response()->json($utenti);
        }

        public function UtenteInfo(){
        $request= request();
        $username= $request->nomeUtente;
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
}

    

