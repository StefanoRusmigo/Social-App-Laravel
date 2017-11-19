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
           
            <form method="post" action="{{ route('show_user',$user->id) }}", 
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
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name')? old('name'): $user->name }}" required autofocus 
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
                                <input id="name" type="text" class="form-control" name="email" value="{{ old('name')? old('name'): $user->email }}" required autofocus
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
            <p><a href="#">Interests</a></p>

           
           
            	<?php  $rand_colors = $colors=['default','success','info','warning','danger'];?>
            <p>
            @foreach($user->interests as $interest)
             <?php 
             if(empty($rand_colors)){$rand_colors= $colors;}
             $color = $rand_colors[0]; 
            array_shift($rand_colors);
             ?>
             @if($auth==1)
              <span class="label label-{{$color}}">{{ $interest->interest  }} <a href="
              {{ route('delete_interest',['interest_id'=>$interest->id,'user_id'=>$user->id]) }} " >
              <i class="fa fa-remove"></i></a></span>
              @else
              <span class="label label-{{$color}}">{{ $interest->interest  }}</span>
              @endif
              
             @endforeach
            </p>

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
            @endif
          </div>
          @if($auth==1)
          @if(count($user->viewers)>0)
          <div class="alert alert-success fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p><strong>Ey!</strong></p>
            People are looking at your profile. Check below to find out who.
          </div>
          @else
           <div class="alert alert-success fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p><strong>Ey!</strong></p>
            No one has looked at your profile
          </div>
          @endif
          @foreach($user->viewers as $viewer)
          <p><a href="{{ route('show_user',$viewer) }}">{{ $viewer->name }}</a></p>
     
          @endforeach
          @endif
        </div>
        </div>
        </div>



@endsection