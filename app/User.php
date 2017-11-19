<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function friends(){
        return $this->belongsToMany('App\User','friend_user','user_id','friend_id');
    }

    public function interests(){
        return $this->belongsToMany('App\Interest');
    }

    public function viewers(){
        return $this->belongsToMany('App\User','user_viewer','user_id','viewer_id');
    }

      public function feed(){
      $friends = $this->friends;

        $feed = array();

        foreach ($friends as $friend) {
             foreach($friend->posts as $post){
                $feed[] = $post;
             }
        }

        foreach ($this->posts as $post) {
            $feed[] = $post;
        }


         uasort($feed, 
        function($a,$b){
            return $a->created_at > $b->created_at ? false: true;
        });

         return $feed;
    }
}
