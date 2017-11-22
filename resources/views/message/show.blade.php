@extends('layouts.app')
@section('content')
@include('layouts.left_sidebar')

<div class="col-sm-7">
  @include('layouts.flash',array('error'=>'success'))
    <div class="row">
       <div class="col-sm-12">

        <h3 align="left">Send Message to {{ $receiver->name }}</h3>
            
                <form method="post" action="{{ route('send_message') }}">
                  <div class="panel panel-default text-left">
                   <div class="panel-body">
                  {{ csrf_field() }}
                  <input type="hidden" name="receiver" value="{{ $receiver->id }}">
                  <div class="form-group">
                     <textarea class="col-sm-12" name="message" rows="4" ></textarea>
                  </div>

                  <div class="form-group">
                        <button type="submit" class="btn btn-primary" 
                                style="float: left;">
                                Send
                        </button>
                  </div>
                  </div>
                  </div>
                </form>
          
              @foreach($receiver->conversation() as $message)
          

                <div class="row">
                  <div class="col-sm-3">
                    <div class="well">
                      <p><a href="/user/{{ $message->user->id }}">
                        {{ $message->user->name }}
                      </a></p>
                        <img src="\storage/{{$message->user->avatar}}" class="img-circle" 
                            height="55" width="55" alt="Avatar">
                      <p>
                        {{ $message->created_at->toFormattedDateString() }}    
                        {{ $message->created_at->toTimeString() }} 
                      </p>
                    </div>
                  </div>
                  <div class="col-sm-9">
                    <div class="well" style="text-align: left;">
                    
                      <p>{{  $message->message }}</p>
                    </div>
                  </div>
                </div>

              @endforeach
           

      
    </div>
</div>
</div>



@include('layouts.right_sidebar')
@endsection