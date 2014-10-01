
<script type="text/javascript">
	$(document).ready(function() {
 
	  $("#recom-feed").owlCarousel({
	 
	      autoPlay: false, //Set AutoPlay to 3 seconds
	 
	      items : 4,
	      itemsDesktop : [1199,3],
	      itemsDesktopSmall : [979,3]
	 
	  });
	 
	});
</script>
<div class="row">
	<div class="col-md-12">
		<div id="recom-feed" class="owl-feeder">
			@if( $videos->count() > 0)
				@foreach( $videos as $i => $v )
					<div class="item">
						<figure>
							<div style="background: url({{ $v->getThumbnail() }}) no-repeat center; background-size:cover;" class="pic-holder shadow-radial">
								<a href="{{ URL::to('watch/'.$v->id) }}">
									<img src="{{ asset('assets/img/whitespace2.png') }}" class="hover" width="100%">
								</a>
							</div>
							<div class="meta">
								<span class="head">
									<a href="{{ URL::to('watch/'.$v->id) }}">{{ $v->getTitle(50) }}</a></span>
								<span class="sub">{{ $v->categoryName() }}</span>
							</div>
						</figure>
					</div>
				@endforeach
			@endif	  	  
		</div>
	</div>
</div>