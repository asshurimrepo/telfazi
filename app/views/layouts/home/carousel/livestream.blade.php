<div id="carousel-livestream" class="carousel slide feeder-carousel" data-ride="carousel" data-interval="false">
  <div class="carousel-inner nopadd">

<div class="nopadd">
  <h2 class="featTitle"><a href="{{ url('live') }}"><span>Live</span> Stream</a></h2>
</div>

<?php 
  $max = 9; $counter = 0; $iterator = 0; 
?>
@if( $videos->count() > 0)
  @foreach( $videos as $i=>$v )
    @if($i%$max == 0)
      <div class="item {{ $i == 0 ? 'active' : '' }}">
        
      <?php $counter = 0; $iterator = 0;  ?>
    @endif

    
    <?php $min = 4; ?>
    @if( $counter < $min )
      @if($counter%$max == 0)
        <div class="lstream-box1 boxy">
      @endif

        @include('layouts.home.carousel.vidsmall', array('v'=>$v))

      @if($counter%$min == $min-1 || ($counter+1 == $min))
        </div>
      @endif
    @else
      <?php $mil = 5; ?>
      @if($iterator%$mil == 0)
        <div class="boxy">
      @endif

        @if($iterator == 0)
          @include('layouts.home.carousel.vidBig', array('v'=>$v))
        @else
          @include('layouts.home.carousel.vidsmall', array('v'=>$v))
        @endif 

      

      @if($iterator%$mil == $mil-1 || ($iterator+1 == $mil))
        </div>
      @endif

      <?php $iterator++; ?>
    @endif




    <?php $counter++;?>
    @if($i%$max == $max-1 || ($i+1 == $videos->count()))

      </div>
    @endif  
  @endforeach
@endif


                 
  </div><!-- end carousel inner -->
  
</div>