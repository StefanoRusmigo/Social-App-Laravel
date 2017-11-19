<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use \Auth;

class PostController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create(Request $request){
    	$this->validate($request,[
    		'body'=>'required|max:240'
    	]);

    	$post = new Post;

    	$post->body = request('body');
    	$post->user_id = Auth::user()->id;

    	$post->save();

    	return redirect('/home');

    }


    public function delete($post_id){
    	if($post = Post::find($post_id) && $post->user == Auth::user()){
    		$post->delete();
    	}else{
            session()->flash('message',"Cant delete this post");
    		return redirect('/home');
    	}

    }
}
