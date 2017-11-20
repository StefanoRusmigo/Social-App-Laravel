<p>
  <a href="#">Interests</a></p>

           
           
            	<?php  $rand_colors = $colors=['default','success','info','warning','danger'];?>
            <p>
            @foreach(Auth::user()->interests as $interest)
             <?php 
             if(empty($rand_colors)){$rand_colors= $colors;}
             $color = $rand_colors[0]; 
            array_shift($rand_colors);
             ?>
             @if(isset($auth) && $auth==1)
              <span class="label label-{{$color}}">{{ $interest->interest  }} <a href="
              {{ route('delete_interest',['interest_id'=>$interest->id,'user_id'=>$user->id]) }} " >
              <i class="fa fa-remove"></i></a></span>
              @else
              <span class="label label-{{$color}}">{{ $interest->interest  }}</span>
              @endif
              
             @endforeach
            </p>