<div class="row">
	<div class="col-md-12">
	
		<!-- Nav tabs -->
		<ul class="list-unstyled list-inline bottomhead" role="tablist">
		  <li class="active"><a href="#recommended" role="tab" data-toggle="tab">Recommended</a></li>
		  <li><a href="#highlights" role="tab" data-toggle="tab">Most Viewed</a></li>
		  <li><a href="#favourite" role="tab" data-toggle="tab">Trending</a></li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content">
		  <div class="tab-pane active" id="recommended">
		  	
		  	@include( 'layouts.frag.feeder_highlights', array('videos' => $recommended, 'carousel_name' => 'carousel_1'))

		  </div>
		  <div class="tab-pane" id="highlights">

		  	@include( 'layouts.frag.feeder_highlights', array('videos' => $mostViewed, 'carousel_name' => 'carousel_2' ))

		  </div>
		  <div class="tab-pane" id="favourite">

		  	<?php $videos = Video::take(8)->get(); ?>
		  	@include( 'layouts.frag.feeder_highlights', array('videos' => $videos, 'carousel_name' => 'carousel_3'))

		  </div>

		</div>		
	</div>
</div>