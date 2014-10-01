<div class="row">
	<div class="col-md-12">

		<ul class="list-unstyled list-inline bottomhead" role="tablist">
		  <li class="active"><a href="#recommended" role="tab" data-toggle="tab">{{ Lang::get('lang.other_live_streams') }}</a></li>
		</ul>

		<div class="tab-content">
		  <div class="tab-pane active" id="recommended">
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
						<?php $total = 10; ?>
						@for( $i = 0; $i < $total; $i++ )

							<div class="item">
								<a href="{{ URL::to('live') }}"><img src="{{ asset('assets/img/ad1.jpg') }}" alt="Owl Image"></a>
							</div>

						@endfor
					</div>
				</div>
			</div>

		  </div>
		</div>		
	</div>
</div>