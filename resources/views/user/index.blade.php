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
            <div class="col-sm-3">
               <a href="{{ route('show_user',$user) }}"> <img src="\storage/{{$user->avatar}}" class="img-circle" height="55" width="55" alt="Avatar"></a>
              </div>
            <div class="col-sm-9">
              <p>
              	<a href="{{ route('show_user',$user) }}">
              		{{ $user->name }}
              	</a>
              </p>
               <p>{{ $user->email}}</p>

                <p></p>
              </div>
              	<div style="clear: both;"></div>

            </div>
         
       	@endforeach

       </div>
   </div>
</div>



@include('layouts.right_sidebar')

@endsection

