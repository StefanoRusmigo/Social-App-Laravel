<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Interest;
use App\Message;
class UserController extends Controller
{

	 public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $search_text =$request->input('text');
        $users = User::where('name', 'LIKE', "%".$search_text."%")
                       ->orderBy('name')->get();
    return view('user.index', compact('users','search_text'));
    }

    public function show($user_id){
    	 $user = User::find($user_id);
         $auth_user = \Auth::user();
    	 $auth = ($auth_user==$user)? 1 :-1;
    	if ($user)
    		{
                $interests = Interest::all()->diff($user->interests);

                if($user->id != $auth_user->id && !($user->viewers->contains($auth_user))){
                    $user->viewers()->attach($auth_user);
                    $user->save();
                }

    			return view('user.show',compact('user','auth','interests'));

    		}else{
                 session()->flash('message',"User not found");
    			return redirect('/home');
    		}
    }


    public function update($user_id){
        $user = User::find($user_id);
    	if ($user && $user==\Auth::user())
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
