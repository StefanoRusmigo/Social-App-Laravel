        <div class="col-sm-3 well">
          <div class="well">
            <p><a href="{{ route('show_user',Auth::user()) }}">My Profile</a></p>
            <img src="\storage/{{Auth::user()->avatar}}" class="img-circle" height="65" width="65" alt="Avatar">
          </div>
          <div class="well">
            @include('layouts.interests')
          </div>
          
          @include('layouts.viewers')
        </div>
    