@extends('layouts.alpha')


@section('content')
	<?php 

	$cats = array();
	foreach($categories as $c){
		$cats[$c->id] = $c->category_name;
	}

	?>

	<div class="row">
		<div class="col-md-12"> 
			<center>
				@include('video.videoplayer')
			</center>
		</div>
	</div>
	<div class="separator-space-sm"></div>

	<div class="row">
		<div class="col-md-12">
			
			@include('video.detail.editform')

		</div>
	</div>
@stop
