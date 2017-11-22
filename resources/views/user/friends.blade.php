@extends('layouts.app')


@section('content')

@include('layouts.left_sidebar')

<div class="col-sm-7">
  @include('layouts.flash')
    <div class="row">
       <div class="col-sm-12">
        <h1 align="left">Friend list</h1>


        <form  role="search" method="post" action="/users/friends" >
            {{ csrf_field() }}
        <div class="form-group input-group">

          <input type="text" class="form-control" name="text" placeholder="Search.." >

          <span class="input-group-btn">
            <button class="btn btn-default" type="submit">
              <span class="glyphicon glyphicon-search"></span>
            </button>
          </span>        
        </div>
      </form>
   

       	  <div class="well">
            @foreach($friends as $friend)
            <div class="form-group">
                  <img src="/storage/{{$friend->avatar}}" class="img-circle col-sm-2" 
                  height="60" width="60" alt="Avatar">
                


              <p class="col-sm-5">
                <a href="/user/{{ $friend }}">{{ $friend->name }}</a>
              </p>


              <p class="col-sm-5">
               {{ $friend->email }}
              </p>

               <div class="col-sm-5">
                <form action="{{ route('remove_friend') }}"  method="POST" ">

                      {{ csrf_field() }}
                      <input type="hidden" name="friend_id" value="{{ $friend->id }}">
                       <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">Remove 
                      <span class="glyphicon glyphicon-user"></span> 
                    </button> 
                  </span>      

                </form>
              </div>

               <div class="col-sm-5">
              <a class="btn btn-default" href="/users/{{ $friend->id }}/message">Send Message
              <span class="glyphicon glyphicon-envelope"></span>
            </a>
               </div>

              

              </div>
              <div style="clear: both;" "></div>
              <hr>

            @endforeach
          </div>
       </div>
   </div>
</div>



@include('layouts.right_sidebar')

@endsection

