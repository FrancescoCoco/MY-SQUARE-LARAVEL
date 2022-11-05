<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{  
    protected $fillable = [
        'title', 'url_img',
        'username', 'date',
    ];
    
    protected $hidden = [
        'username',
    ];

    public function user(){
        return $this->belongsTo("App\User");
    }

    public function likes(){
        return $this->belongsToMany("App\Models\Post","hw2likes");
    }
}
