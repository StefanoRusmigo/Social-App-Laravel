<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Comment;
use App\Post;

class CommentController extends Controller
{

	 public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request){
    	$user = User::find(request('user_id'));
    	$post = Post::find(request('post_id'));
    	$comment = new Comment;

    	$this->validate($request,[
    		'body'=>'required|max:240'
    	]);

    
    	if($user && $post){
    		$comment->body = request('body');
    		$comment->user_id = $user->id;
    		$comment->post_id = $post->id;
    		$comment->save();
    		return back();
    	}else{
    		session()->flash('message','Error occured while saving the comment');
    		return back();
    	}
    }
}
