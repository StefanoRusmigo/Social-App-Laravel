<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Interest;
class UserController extends Controller
{

	 public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($user_id){
    	 $user = User::find($user_id);
    	 $auth = (\Auth::user()==$user)? 1 :-1;
    	 $interests = Interest::all();
    	if ($user )
    		{

    			return view('user.show',compact('user','auth','interests'));

    		}else{
                 session()->flash('message',"User not found");
    			return redirect('/home');
    		}
    }


    public function update($user_id){
    	if ($user = User::find($user_id) && $user=\Auth::user())
    		{
    			if(request('avatar')) { 
       			 $image_path = request('avatar')->store('/public');
       			 $user->avatar = basename($image_path);
       			}
    			$user->name = request('name');
    			$user->email = request('email');
    			$user->save();
    			return redirect(route('show_user', $user_id));
    		}else{
                 session()->flash('message',"Cannot update user");
    			return redirect(route('show_user', $user_id));
    		}

    }
}
