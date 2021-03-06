<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }

      public function comments(){
        return $this->hasMany('App\Comment','post_id')->orderBy('created_at','DESC');
    }

  
}
