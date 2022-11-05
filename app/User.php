<?php

namespace App;

use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'username', 
        'email', 'password','photo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(){
        return $this->hasMany("App\Models\Post");
    }

    public function likes(){
        return $this->belongsToMany("App\Models\Post","hw2likes");
    }

    public function followers(){
        return $this->belongsToMany("App\User","hw2followers","username","user_follower");
    }

    public function followed(){
        return $this->belongsToMany("App\User","hw2followers","username","user_followed");
    }
    
    public function setPhotoAttribute($value){
        $path= $value ? Storage::disk("public")->put("userImage",$value) : null;
        $this->attributes["photo"]= $path;
    }
    
    public function getPhotoAttribute($value){
       return $value ? Storage::disk("public")->url($value) : asset("images\default.jpg");
       //return $value ? asset("storage/app/public/"."$value") : asset("images\default.jpg");
    }
    
}
