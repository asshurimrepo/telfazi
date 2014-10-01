<?php 

	// Default Page 
	$show_per_load = 18;
	$count = count($feed);
	$total = ceil($count/$show_per_load);
	$gr_name = isset($gr_name) ? $gr_name : 'gr';

	// echo $total;

?>

@if( count( $feed ) > 0 )
	<div class="row" style="padding:0 12px;">
	<?php $i = 0; ?>
	@foreach($feed as $j=>$v)
	    @if($i%2 == 0) 
			<div class="col-md-12"></div>
	    @endif

	    @include('layouts.home.carousel.vidsmall', array('v' => $v, 
	    	'column_class' => 'col-md-6 '. $gr_name.'_'.ceil(($i+1)/$show_per_load).' hide'))

	     <!-- <div class="col-md-6 col-xs-6 {{ $gr_name }}_{{ ceil(($i+1)/$show_per_load) }} hide">
			<div class="vidThumb">
				<div style="background: url({{ $v->getThumbnail() }}) no-repeat center; 
					background-size:cover;">
					<a href="{{ URL::to('watch/'.$v->id) }}">
					  <img src="{{ asset('assets/img/whitespace.png') }}" class="hover playarrow-ver ">
					</a>
				</div>
				
				<span class="burb"><a href="{{ URL::to('watch/'.$v->id) }}" title="{{ $v->title }}">
					{{ $v->getTitle(25) }}</a></span>
				<span class="date">{{ date('F d Y', strtotime($v->getCreatedAt())) }}</span>  
				<span class="views"><em>{{ $v->getViews() }}</em> {{ Lang::get('lang.views') }}</span>
			</div> 
		</div> -->

		<?php $i++; ?>
	@endforeach

	</div>

	@if($count > $show_per_load)
	 <div class="row">
	 	 <div class="col-md-9 col-md-offset-2">
	 	 	<button type="button" id="{{ $gr_name }}_load-more" data-loading-text="Fetching..." class="btn btn-block btn-primary">
	  			{{ Lang::get('lang.show_more') }}
		  </button>
	 	 </div>
	 </div>

	@endif	

@else
<div class="text-center"> 
	<em>No Related Videos</em>
	<div class="separator-space-sm"></div>
</div>
@endif 


<script type='text/javascript'>

	


	var {{ $gr_name }}_max_load = {{ $total }};
	var {{ $gr_name }}_default_load = 1;

	$(document).ready(function(){

		$(".{{ $gr_name }}_1").removeClass('hide');

		$('#{{ $gr_name }}_load-more').click(function () {
    		var btn = $(this);
		    btn.button('loading');

		    setTimeout(function(){
		    	{{ $gr_name }}_default_load++;
		    	btn.button('reset');

				$(".{{ $gr_name }}_"+{{ $gr_name }}_default_load).removeClass('hide').hide().show('fast');


		    	if({{ $gr_name }}_default_load >= {{ $gr_name }}_max_load) btn.fadeOut('fast');


		    }, 700);
		});

	});

</script>