
<script type="text/javascript">
	$(document).ready(function() {
 
	  $("#owl-demo").owlCarousel({
	 
	      autoPlay: 3000, //Set AutoPlay to 3 seconds
	 
	      items : 5,
	      itemsDesktop : [1199,3],
	      itemsDesktopSmall : [979,3]
	 
	  });
	 
	});
</script>
<div class="row">
	<div class="col-md-12">
		<div id="owl-demo">

			@foreach ( $streams as $s )
				<div class="item">
					<div style="background: url({{ $s->getThumbnail() }}) no-repeat center; 
						background-size:cover;">
						<a href="{{ URL::to('live/'.$s->id) }}">
						  <img src="{{ asset('assets/img/whitespace2.png') }}" 
						  	class="">
						</a>
					</div>
				</div>
			@endforeach
		</div>
	</div>
</div>