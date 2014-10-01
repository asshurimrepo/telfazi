@extends('layouts.alpha')


@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="pull-right">
			<a href="{{ url('browse/category/1')}}" class="btn btn-default btn-xs"><i class="fa fa-play"></i> See All</a>
		</div>
		<div class="pull-left feeder-header"><b>SOCCER</b> </div>
	</div>

	<div class="col-md-12">
		@include( 'layouts.frag.feeder_highlights', array('videos' => $soccerVids, 'carousel_name' => 'carousel_1'))
	</div>
</div>
<div class="line-separator"></div>
<div class="separator-space"></div>


<div class="row">
	<div class="col-md-12 ">
		<div class="pull-right ">
			<a href="{{ url('browse/category/2')}}" class="btn btn-default btn-xs"><i class="fa fa-play"></i> See All</a>
		</div>
		<div class="feeder-header"><b>AUTOMOTIVE</b> </div>
	</div>

	<div class="col-md-12">
		@include( 'layouts.frag.feeder_highlights', array('videos' => $automotiveVids, 'carousel_name' => 'carousel_2'))
	</div>
</div>
<div class="line-separator"></div>
	
@stop

