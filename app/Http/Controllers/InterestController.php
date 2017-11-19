<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Interest;
class InterestController extends Controller
{
    public function create($user_id, Request $request){
    	if(($user = User::find($user_id)) && $user == \Auth::user()){
    		$interest = Interest::find(request('interests'));

    		if(!($user->interests->contains($interest))){
    			$user->interests()->attach($interest);
    			return redirect(route('show_user',$user_id));
    		}else{
       			 session()->flash('message',$interest->interest." already exists");

    			return redirect(route('show_user',$user_id));
    		}
    		
    	}
    		session()->flash('message',"Cant update");
    		return redirect(route('show_user',$user_id));
    	
    }


    public function delete($interest_id,$user_id){
    	$interest = Interest::find($interest_id);
    	$user = User::find($user_id);
    	if($user && $interest && $user == \Auth::user()){
    		if($user->interests()->detach($interest)){
    		  return redirect(route('show_user',$user_id));
    		}

    	}
       		session()->flash('message',"Cant delete interest");
    		return redirect(route('show_user',$user_id));
    	
    }
}
