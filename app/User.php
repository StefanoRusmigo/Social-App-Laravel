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
        return $this->belongsToMany('App\User','user_viewer','user_id','viewer_id')->orderBy('created_at');
    }

    public function messages_receive(){
        return $this->hasMany('App\Message','receiver_id');
    }

       public function messages_send(){
        return $this->hasMany('App\Message','user_id');
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

    public function conversation(){
        $conv = array();
        $receive = \Auth::user()->messages_receive->where('user_id','=',$this->id);
        $send = \Auth::user()->messages_send->where('receiver_id','=',$this->id);
       
        foreach($receive as $mes){
             $conv[] =$mes;
        }

         foreach($send as $mes){
             $conv[] =$mes;
        }

        uasort($conv, 
        function($a,$b){
            return $a->created_at > $b->created_at ? false: true;
        });
        return $conv;
    }

    public function unseen(){
      return  $this->messages_receive()->where('seen','=',false);

    }

    public function unseen_grouped(){
      $unseen =  $this->unseen();
      $group_unseen = array();
      $times = 1;      

      foreach($unseen->get() as $value){
        if(array_key_exists($value->user->name,$group_unseen)){
            $group_unseen[$value->user->name][0] +=1;
        }else{
       $group_unseen[$value->user->name] = array($times,$value->user->id);

        }
      }
      return $group_unseen;
    }


}
