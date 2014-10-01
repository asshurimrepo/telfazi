<div class="vidBracket">
  	<div class="partition">
  		<button class="mybtn btn-channel">{{ $title }}</button>
  		<div class="line-separator"></div>
  	</div>

    <div id="{{ $vid }}" class="carousel slide" data-ride="carousel">

  <!-- Wrapper for slides -->
  <div class="carousel-inner">


    
            @if( count($v_feed) > 0 )
              @foreach($v_feed as $i=>$v)
                @if($i%6 == 0)
					
					       <div class="item {{ $i == 0 ? 'active' : '' }}">
				          <div class="vidGroup">
				            <ul class="vidthumb-slider" d="Recent">

                @endif
					
      				<?php 
      					if(!isset($v->id)){
      						 $v = $v->video;	
      					}?>

                @if(isset($v->id))
                  <li><a href="{{ URL::to('watch/'.$v->id) }}" class="tips" title="{{ $v->title }}"><img src="{{ asset( 
                  $v->getThumbnail() ) }}" alt="..."></a>
                  </li>  
                @endif
				
        				@if($i%6 == 5 || ($i+1 == count($v_feed))) 
        						   </ul>
        				        </div>
        				    </div>
        				@endif


              @endforeach
            @endif
    </div>
  	



    @if( count($v_feed) > 6 )
    <!-- Controls -->
    <a class="left carousel-control" href="#{{ $vid }}" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="right carousel-control" href="#{{ $vid }}" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
    @endif
</div>

    
</div>
