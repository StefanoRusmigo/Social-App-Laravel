 @if($flash= session('message'))
      <div class="alert alert-danger" role="alert">
        
        {{ $flash }}
      </div>
    @endif