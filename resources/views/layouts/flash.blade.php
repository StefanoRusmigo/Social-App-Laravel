 @if($flash= session('message'))
      <div class="alert alert-{{ isset($error)? $error:'danger' }}" role="alert">
        
        {{ $flash }}
      </div>
    @endif