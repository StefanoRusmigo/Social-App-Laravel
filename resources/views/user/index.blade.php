@extends('layouts.app')


@section('content')

@include('layouts.left_sidebar')

<div class="col-sm-7">
  @include('layouts.flash')
    <div class="row">
       <div class="col-sm-12">
       	<p><strong>Names</strong></p>
       	@foreach($users as $user)

       	
              <div class="well">
            <div class="col-sm-2">
               <a href="{{ route('show_user',$user) }}"> <img src="\storage/{{$user->avatar}}" class="img-circle" height="55" width="55" alt="Avatar"></a>
              </div>
            <div class="col-sm-10">
              <p>
              	<a href="{{ route('show_user',$user) }}">
              		{{ $user->name }}
              	</a>
              </p>
               <p>{{ $user->email}}</p>
        @if(!(Auth::id()==$user->id))      
          <form action="{{Auth::user()->friends->contains($user)?
           route('remove_friend'):route('add_friend') }}"  method="POST" ">

              {{ csrf_field() }}
              <input type="hidden" name="friend_id" value="{{ $user->id }}">
              <input type="hidden" name="search_text" value="{{ $search_text }}">

               <span class=" 10">
            <button class="btn btn-default" type="submit">{{ Auth::user()->friends->contains($user)? 'Remove friend':'Add friend' }}
              <span class="glyphicon glyphicon-user"></span>
            </button>
                 
          </form>


            <a class="btn btn-default" href="/users/{{ $user->id }}/message">Send Message
              <span class="glyphicon glyphicon-envelope"></span>
            </a>
          </span>        
        @else 
            <p>
              <a href="/user/{{ $user->id }}">Edit my profile</a>
            </p>    
        @endif
              
        
              
              </div>
              	<div style="clear: both;"></div>

            </div>
         
       	@endforeach

       </div>
   </div>
</div>



@include('layouts.right_sidebar')

@endsection

