@extends('layouts.alpha')


@section('content')

@include('scripts.fblogin')
<?php 
$video = Video::find(3); 
$tags = array();
if($video->tags){
	$tags = $video->getTags();	
}

$singleTab = count($tags) > 0 ? $tags[array_rand($tags)] : "";
?>
<div class="row">
    <div class="col-md-12">
      <ul class="list-unstyled list-inline pull-right">
        <li class="ti">Follow us</li>
        <li><img src="{{ asset('assets/img/rss_icon.png') }}"> </li>
        <li><img src="{{ asset('assets/img/twitter.png') }}"></li>
        <li><img src="{{ asset('assets/img/facebok.png') }}"></li>
      </ul>
    </div>
</div>

<div class="row">
	<div class="col-md-8">
		<div id="myElement">
			<img src="{{ asset('assets/img/Livestream.jpg') }}" width="610">
			<!-- VIDEO PLAYER GOES HERE -->
		</div>

		<div class="separator-space"></div>

		<div class="info-border">
			<div class="bg-info info-head" style="">
				<i class="fa fa-facebook-square"></i>  Facebook Feed
			</div>
			<div class="info-space">
				<div class="fb-comments"
				data-href="http://emman.cjnetsolutions.com/telfasi/public/watch/5"
				data-width="100%"
				data-numposts="5" data-colorscheme="light">
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div> <img src="{{ asset('assets/img/mpu.jpg') }}" width="290" height="240" class="img-responsive"> </div>
		<div class="separator-space-sm"></div>

		<div class="">
			<div class="bg-info info-head" style="">
				<i class="fa fa-youtube-play"></i> Recommended
			</div>
			<div class="separator-space-sm"></div>
			<div class="row">	
				<div class="col-md-6 col-xs-6">
				  <div class="vidThumb">
				    <a href="#"><img src="{{ asset('assets/img/thumb3.jpg') }}" alt="213" class="img-responsive"></a>
				    <span class="burb">asdakdla;sdkl;</span>
				    <span class="date">September 23, 2012</span>  
				    <span class="views"><em>1231231</em> views</span>
				  </div>
				</div>

				<div class="col-md-6 col-xs-6">
				  <div class="vidThumb">
				    <a href="#"><img src="{{ asset('assets/img/thumb3.jpg') }}" alt="213" class="img-responsive"></a>
				    <span class="burb">asdakdla;sdkl;</span>
				    <span class="date">September 23, 2012</span>  
				    <span class="views"><em>1231231</em> views</span>
				  </div>
				</div>
			</div>
		</div>

		
	</div>
</div>


<div class="separator-space"></div>
<div class="row">
	<div class="col-md-12">
		<ul class="list-unstyled list-inline bottomhead">
			<li><a href="#">Recommended</a></li>
			<li><a href="#">Highlights</a></li>
			<li><a href="#">Men`s Favourite</a></li>
			<li><a href="#">Episodes</a></li>
			<li><a href="#">Top Rated</a></li>
		</ul>

		<div id="owl-demo" class="owl-carousel">
		    <div>
		        <img src="{{ asset('assets/img/stream1.jpg') }}" alt="" />
		        <img src="{{ asset('assets/img/stream1.jpg') }}" alt="" />
		    </div>
		    <div>
		        <img src="{{ asset('assets/img/stream1.jpg') }}" alt="" />
		        <img src="{{ asset('assets/img/stream1.jpg') }}" alt="" />
		    </div>
		    <div>
		        <img src="{{ asset('assets/img/stream1.jpg') }}" alt="" />
		        <img src="{{ asset('assets/img/stream1.jpg') }}" alt="" />
		    </div>
		    <div>
		        <img src="{{ asset('assets/img/stream1.jpg') }}" alt="" />
		        <img src="{{ asset('assets/img/stream1.jpg') }}" alt="" />
		    </div>
		    <div>
		        <img src="{{ asset('assets/img/stream1.jpg') }}" alt="" />
		        <img src="{{ asset('assets/img/stream1.jpg') }}" alt="" />
		    </div>
		    <div>
		        <img src="{{ asset('assets/img/stream1.jpg') }}" alt="" />
		        <img src="{{ asset('assets/img/stream1.jpg') }}" alt="" />
		    </div>
		    <div>
		        <img src="{{ asset('assets/img/stream1.jpg') }}" alt="" />
		        <img src="{{ asset('assets/img/stream1.jpg') }}" alt="" />
		    </div>


		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$(document).ready(function () {
		    $("#owl-demo").owlCarousel({
		       
		        pagination: true
		    });
		});
	});

</script>
<style type="text/css">

</style>
@stop
