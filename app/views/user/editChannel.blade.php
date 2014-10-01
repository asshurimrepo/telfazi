@extends('layouts.alpha')

@section('content')

<div class="separator-space-xsm"></div>


<div class="row admin-nav">
	<div class="col-md-2">
		@include('user.sidebar.sidebar')
	</div>
	
	<div class="col-md-10">
		<h4 style="margin-top:0px; ">Edit Channel</h4>

		@include('channel.edit')
	</div>
</div>

@stop

