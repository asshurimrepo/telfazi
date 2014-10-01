@extends('layouts.alpha')

@section('content')
	<div class="row">
		<div class="col-md-6"> 
			<div class="pull-left mytitle">
				{{ $channel->channelName() }} Channel

				@if(Auth::check())
					@if($channel->user->id == Auth::user()->id)
						<a href="{{ URL::to('mytv/channels/edit/'.$channel->channel_id) }}" class="btn btn-primary btn-xs">edit</a>
					@endif
				@endif
				
			</div>
		</div>

		<div class="col-md-6"> 
			<div class="pull-right mytitle">
				Channel Category
			</div>
		</div>
		
	</div>
	<div class="separator-space-xsm"></div>


	<div class="row">
		<div class="col-md-12">
			<div class="separator-space-sm"></div>

			@include('layouts.frag.feeder_browsing', array('videos'=>$videos))

			
		</div>
	</div>
@stop
