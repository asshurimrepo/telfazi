<script type="text/javascript">
	$(function(){
		//CAROUSEL
	    $("#{{ $carousel_name }}").owlCarousel({
	        pagination: true,
	        items: 5
	    });
	});
</script>


@if( count($videos) > 0 )
	<div id="{{ $carousel_name }}" class="owl-carousel">
		
	@foreach( $videos as $i => $v )
		@if( $i % 2 == 0)
			<div>	
		@endif
			<div style="background: url({{ $v->getThumbnail() }}) no-repeat center; 
					background-size:cover;">
				<a href="{{ URL::to('watch/'.$v->id) }}">
				  <img src="{{ asset('assets/img/whitespace.png') }}" class="hover playarrow-ver img-responsive">
				</a>
			</div>
		@if( $i % 2 == 1 || ($i+1 == count($videos) ) )
			</div>
		@endif
		
	@endforeach
	</div> 
@endif

