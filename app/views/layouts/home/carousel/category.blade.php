
@if( count($videos) > 0 )

<div class="nopadd">
	<h2 class="featTitle"> <a href="{{ $catUrl}}">{{ $title }}</a> </h2>
</div>


<div id="{{ $carousel_name }}" class="carousel slide feeder-carousel" data-ride="carousel" data-interval="false">
  <div class="carousel-inner nopadd">



<?php $max = 12; ?>
@if( $videos->count() > 0)
  @foreach( $videos as $i=>$v )
    @if($i%$max == 0)
    <div class="item {{ $i == 0 ? 'active' : '' }} ">
      <div class="boxy">
        <div class="row vidlist">
    @endif


    @include('layouts.home.carousel.vidsmall', array('v' => $v))


    @if($i%$max == $max-1 || ($i+1 == $videos->count()))
        </div>
      </div>
    </div>
    @endif  

  @endforeach
@endif

<!-- <div class="item active">

<div class="boxy">
	<div class="row vidlist">
	@foreach( $videos as $v )
		
			@include('layouts.home.carousel.vidsmall', array('v' => $v))
		
	@endforeach
	</div>
</div> 


</div> --> <!-- end item -->


                 
  </div><!-- end carousel inner -->
  <!-- Controls -->
  <a class="left carousel-control" href="#{{ $carousel_name }}" role="button" data-slide="prev">
  <span class="left-control"> <i class="fa fa-angle-left"></i> </span>
  </a>
  <a class="right carousel-control" href="#{{ $carousel_name }}" role="button" data-slide="next">
  <span class="right-control"> <i class="fa fa-angle-right"></i>  </span>
  </a>
</div>
@endif