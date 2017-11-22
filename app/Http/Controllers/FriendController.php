<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class FriendController extends Controller
{
	public function __construct(){
        $this->middleware('auth');

	}

    public function index(){
        if($search_text = request('text')){
            $friends = \Auth::user()->friends()->where('name', 'LIKE', "%".$search_text."%")
                       ->orderBy('name')->get();
        }else{ 
            $friends = \Auth::user()->friends;
        }
        return view('user.friends',compact('friends'));
    }

    public function create(){
    	$user = \Auth::user();
    	$friend = User::find(request('friend_id'));
        if($user->id!=$friend->id){
    	$user->friends()->attach($friend);
    	$user->save;
         }else{
            session()->flash('message','Cant friend yourself');
         }

    	if($search_text = request('search_text')){
        return redirect(route('filter_users',['text'=>$search_text]));
        }

        return back();
    	
    }

    public function delete(){
    	$user = \Auth::user();
    	$friend = User::find(request('friend_id'));
    	$user->friends()->detach($friend);
    	$user->save;
    	$search_text = request('search_text');

        if($search_text = request('search_text')){
        return redirect(route('filter_users',['text'=>$search_text]));
        }

        return back();
    	

    }
}
