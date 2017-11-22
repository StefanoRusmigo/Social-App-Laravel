<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    

    public function show($user_id){

        if($receiver = User::find($user_id)){
        	$seen_messages = \Auth::user()->unseen->where('user_id','=',$user_id);
        	foreach($seen_messages as $message){
        		 $message->seen = true;
        		 $message->save();
        	}
           return view('message.show',compact('receiver'));
        }
    }

    public function create(Request $request){
        $receiver = User::find($request->input('receiver'));
        $message = new Message;
        if($receiver){
            $message->message = $request->input('message');
            $message->user_id = \Auth::id();
            $message->receiver_id =  $receiver->id;
            $message->save();
            session()->flash('message','Message send');
        }

        return redirect("/users/".$receiver->id."/message");
        
    }
}
