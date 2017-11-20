        @if( $user->id ==  \Auth::user()->id )
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
         <p><strong>People that checked your profile</strong></p>
          @foreach($user->viewers as $viewer)
          <p><a href="{{ route('show_user',$viewer) }}">{{ $viewer->name }}</a></p>
     
          @endforeach
          @endif