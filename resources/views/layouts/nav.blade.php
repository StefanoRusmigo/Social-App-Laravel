<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="/">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="/">Home</a></li>
        <li><a href="/users/friends">Friends</a></li>
        @guest
        <li><a href="#">Messages</a></li>
        @else
        <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                  New messages({{ count(Auth::user()->unseen_grouped()) }} ) <span class="caret"></span>
                                </a>
                               @if(count(Auth::user()->unseen_grouped())>0) 
                                <ul class="dropdown-menu">
                                  @foreach(Auth::user()->unseen_grouped() as $key => $value)
                                    <li>
                                        <a href="/users/{{ $value[1] }}/message">
                                           by:  {{ $key }}({{ $value[0] }})
                                        </a>
                                    </li>
                                  @endforeach
                                </ul>
                              @endif
                            </li>

        @endguest

      </ul>
      <form class="navbar-form navbar-right" role="search" method="post" 
            action="{{ route('filter_users') }}" id="search_form">
            {{ csrf_field() }}
        <div class="form-group input-group">

          <input type="text" class="form-control" name="text" placeholder="Search.." >

          <span class="input-group-btn">
            <button class="btn btn-default" type="button" onclick="document.getElementById('search_form').submit(); ">
              <span class="glyphicon glyphicon-search"></span>
            </button>
          </span>        
        </div>
      </form>
      <ul class="nav navbar-nav navbar-right">

        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                   <span class="glyphicon glyphicon-user"></span> {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>

                                    <li>
                                     <a href="{{ route('show_user',Auth::user()->id) }}">Profile</a> 
                                    </li>
                                </ul>
                            </li>
                        @endguest

      </ul>
    </div>
  </div>
</nav>