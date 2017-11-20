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
               <p>{{ $post->user->name }}</p>
               <img src="storage/{{$post->user->avatar}}" class="img-circle" height="55" width="55" alt="Avatar">
              </div>
            </div>
            <div class="col-sm-9">
              <div class="well">
                <p>{!! $post->body !!}</p>
              </div>
            </div>
          </div>

          @endforeach
             
        </div>
    @include('layouts.right_sidebar')
        
     

@endsection
