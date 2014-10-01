@if( isset( $is_livestream ) && $is_livestream)
<div class="nopadd">
  <h2 class="featTitle"><a href="{{ url('live') }}">
    {{ Lang::get('lang.live_streaming') }}</a>
  </h2>
</div>
@endif


<div id="{{ $carousel_name }}" class="carousel slide feeder-carousel" data-ride="carousel" data-interval="false">
  <div class="carousel-inner nopadd">


<?php $max = 9; ?>
@if( $videos->count() > 0)
  @foreach( $videos as $i=>$v )
  <?php $isBig = false;?>
    @if($i%$max == 0)
    <div class="item {{ $i == 0 ? 'active' : '' }} ">
      <div class="boxy">
        <div class="row vidlist">
      <?php $isBig = true;?>
    @endif


    @if( $isBig ) 
        @include('layouts.home.carousel.vidBig', array('v' => $v))
    @else 
      
        @include('layouts.home.carousel.vidsmall', array('v' => $v))
    @endif 


    @if($i%$max == $max-1 || ($i+1 == $videos->count()))
        </div>
      </div>
    </div>
    @endif  

  @endforeach
@endif



                 
  </div><!-- end carousel inner -->

  <!-- Controls -->
  <a class="left carousel-control" href="#{{ $carousel_name }}" role="button" data-slide="prev">
  <span class="left-control"> <i class="fa fa-angle-left"></i> </span>
  </a>
  <a class="right carousel-control" href="#{{ $carousel_name }}" role="button" data-slide="next">
  <span class="right-control"> <i class="fa fa-angle-right"></i>  </span>
  </a>
</div>