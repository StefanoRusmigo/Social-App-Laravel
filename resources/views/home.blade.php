@extends('layouts.app')

@section('content')
    @include('layouts.left_sidebar')

        <div class="col-sm-7">
        
          <div class="row">
            <div class="col-sm-12">
              <form method="POST" action="/home" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="panel panel-default text-left">
                <div class="panel-body">
           
                  <input type="textarea" name="body" value="Status: Feeling Blue" 
                         class="status_text">
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
          
          <div class="row">
            <div class="col-sm-3">
              <div class="well">
               <p>John</p>
               <img src="bird.jpg" class="img-circle" height="55" width="55" alt="Avatar">
              </div>
            </div>
            <div class="col-sm-9">
              <div class="well">
                <p>Just Forgot that I had to mention something about someone to someone about how I forgot something, but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.</p>
              </div>
            </div>
          </div>
          
             
        </div>
    @include('layouts.right_sidebar')
        </div>
      </div>
    </div>

@endsection
