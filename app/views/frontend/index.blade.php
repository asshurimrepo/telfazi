@extends('layouts.alpha')

@section('content')

	<?php
		$data = array(
			'video' => $video,
			'videoList' => $videoList
		);

	?>

	@include('video.homeplayer', $data)



	<div class="separator-space"></div>


	<div class="row" >
	  <div id="sortingArea" >
	    <!-- loads the categories -->
	  </div>
	</div>
@stop

@section('scripts')
	$('#sortingArea').load('{{ URL::to("categories") }}', function( response ){

	});
@stop