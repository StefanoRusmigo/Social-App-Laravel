@extends('layouts.app')
@section('content')

<div class="col-md-2"></div>
   <div class="col-md-8  " align="center">
      <div class="row">
        <div class="col-sm-12 well">
          <div class="well">
@include('layouts.flash')
            @if($auth==1)
            <p>My Profile</p>
            @else
           <p>{{ $user->name }}</p>
            @endif
           
            <form method="post" action="{{ route('update_user',$user->id) }}", 
            	  enctype="multipart/form-data">
            	 {{ csrf_field() }}

            	  <div class="form-group">
            	  	<img src="/storage/{{$user->avatar}}" class="img-circle" 
          		  	height="65" width="65" alt="Avatar">
            	  </div>

          @if($auth==1)
            		<div class="form-group">
            			<div class="col-md-6  col-md-offset-4 ">
            	  	<input type="file" name="avatar" style="float: left;">
          		  	</div>
            		</div>
				  @endif


            	 	<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" 
                                value="{{  $user->name }}" required autofocus 
                                {{ $auth==1?'':'readonly' }}>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                     	</div>

                     	<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Email</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="email" 
                                value="{{ $user->email }}" required autofocus
                                {{ $auth==1?'':'readonly' }}> 

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                     	</div>
                      
                     	@if($auth==1)
                     	<div class="form-group">
                            <div class="col-md-6  col-md-offset-4  " >
                                <button type="submit" class="btn btn-primary" style="float: left;">
                                    Save
                                </button>
                            </div>
                        </div>
                        @endif
                     	<div style="clear: both;"></div>
            </form>
            


          </div>
          <div class="well">
            @include('layouts.interests')

             @if($auth==1)
            <form method="post" action="{{ route('create_interest', $user->id)  }}">
            {{ csrf_field() }}      
          <div class="form-group">
            <select name="interests" class="btn btn-primary dropdown-toggle">
              @foreach($interests as $interest)
              <option value="{{ $interest->id }}">{{ $interest->interest }}</option>
              @endforeach
            </select>
        
            <input type="submit" name="submit" value="Add" class="btn btn-primary"></div>
            </form>
          @include('layouts.viewers')
            @else
          </div>

          <form action="{{Auth::user()->friends->contains($user)?
           route('remove_friend'):route('add_friend') }}"  method="POST" ">

              {{ csrf_field() }}
              <input type="hidden" name="friend_id" value="{{ $user->id }}">
               <span class="input-group-btn">
            <button class="btn btn-default" type="submit">{{ Auth::user()->friends->contains($user)? 'Remove friend':'Add friend' }}
              <span class="glyphicon glyphicon-user"></span>
            </button>
          </span>        
          </form>
          @endif
        </div>
        </div>
        </div>

</div>



@endsection