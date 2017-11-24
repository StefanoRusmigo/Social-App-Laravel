@extends('layouts.app')

@section('content')

    @include('layouts.left_sidebar')

        <div class="col-sm-7">
        @include('layouts.flash')
          <div class="row">
            <div class="col-sm-12">
              <form method="POST" action="/home" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="panel panel-default text-left">
                <div class="panel-body">
           
                  <input type="textarea" name="body" placeholder="Status: Feeling Blue" 
                         class="status_text" maxlength="240">
                @include('layouts.errors')             

                  <input type="submit" name="submit" value="submit" class="btn btn-primary" style="float: right;">

                    <!-- <button type="button" class="btn btn-default btn-sm">
                    <span class="glyphicon glyphicon-thumbs-up"></span> Like
                  </button>    --> 

                </div>
              </div>

              </form>

              
            </div>
          </div>
          @foreach($user->feed() as $post)

          <div class="row">
            <div class="col-sm-3">
              <div class="well">
               <p><a href="/user/{{ $post->user->id }}">{{ $post->user->name }}</a></p>
               <img src="\storage/{{$post->user->avatar}}" class="img-circle" height="55" width="55" alt="Avatar">
              </div>
            </div>
            <div class="col-sm-9">
              <div class="well">
                <p>{!! $post->body !!}</p>
                  <div class="well">
                    <form method="post" action="\comments">
                      {{ csrf_field() }}
                      <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                      <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <div >
                                <input id="name" type="text" class="form-control" name="body" 
                                style="margin: 1px;" required autofocus>

                                @if ($errors->has('body'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                                
                            </div>
                            <input type="submit" name="submit" value="Comment" class="btn btn-primary" style="float: right;">
                            <div style="clear: both;"></div>
                    </form>
                    @foreach($post->comments as $comment)
                      
                      <div class="well">
                        <div class="col-sm-3" style="border-right: 1px solid #e3e3e3">
                            <a href="/user/{{ $comment->user_id }}">
                              <img src="\storage/{{$comment->user->avatar}}" class="img-circle" height="55" width="55" alt="Avatar" style="float: left;">     
                            </a>   
                      </div>
                      <div class="col-sm-9">
                        <p style="text-align: left;">
                        {{ $comment->body }}
                        </p>
                      </div>
                       <div style="clear: both;"></div>
                      </div>
                           

                    @endforeach
                  </div>
              </div>
            </div>
          </div>

          @endforeach
             
        </div>
    @include('layouts.right_sidebar')
        
     

@endsection
