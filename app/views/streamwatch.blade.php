@extends('layouts.alpha')

@include('scripts.fblogin')


@section('content')

@include('layouts.home.socialbtns')

<div class="row">
	<div class="col-md-8">
		<div class="alpha-header">
			<h3><b>{{ $video->sub_name }}</b></h3>
			<h4>{{ $video->getStreamCategory()->title }}</h4>
		</div>
		@if($video->embed)
			{{ $video->embed }}
		@else
			@if($video->getStreamCategory()->slug == 'music') 
			<div id="player">
				<!-- VIDEO PLAYER GOES HERE -->

				<script type="text/javascript">
		
					jwplayer('player').setup({
						playlist: '{{ $video->video_url }}',
					    width: '100%',
						height: "550",
					});
				
				</script>
			</div>
			@else 
			<div id="player">
				<!-- VIDEO PLAYER GOES HERE -->

				<script type="text/javascript">
		
					jwplayer('player').setup({
						file: '{{ $video->video_url }}',
					    width: '100%',
						height: "550",
					});
				
				</script>
			</div>
			@endif 
		@endif

		

		<div class="separator-space-sm"></div>
		
		@include('layouts.frag.feeder_descriptionbox', array('video' => $video))

		<!-- Facebook Feed -->

		 @include('scripts.facebookfeed')
		

		<!-- Facebook Feed -->

	</div>
	<div class="col-md-4">
		
		@include('components.mpu')

		<div class="separator-space-sm"></div>

		<div class="">
			<div class="bg-info info-head" style="">
				<i class="fa fa-twitter-square"></i> Twitter Feeds
			</div>
			
			<div class="info-space twitter-space">
				
				 @include('scripts.twitterfeed') 

	
			</div>
		</div>

		
	</div>
</div>

<div class="separator-space"></div>


<div class="row">
	<div class="col-md-12">
	
		<!-- Nav tabs -->
		<ul class="list-unstyled list-inline bottomhead" role="tablist">
		  <li class="active"><a href="#streams" role="tab" data-toggle="tab">{{ Lang::get('lang.other_live_streams') }}</a></li>
		</ul>

		@include('layouts.frag.feeder_stream')
	</div>
</div>

@include('layouts.others.loginmodal')

<script type="text/javascript">
	$(document).ready(function () {
	    $("#owl-demo").owlCarousel({
	       
	        pagination: true
	    });
	});
</script>

<style type="text/css">
#owl-demo .owl-item > div img {
    display: block;
    width: 100%;
    height: auto;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    margin-bottom:8px;
}
#owl-demo .owl-item > div {
    padding: 0px 4px
}
</style>
@stop
