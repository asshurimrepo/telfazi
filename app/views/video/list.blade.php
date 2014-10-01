@extends('layouts.alpha')


@section('content')
	<h2>Tagged Videos</h2>

	@if(count($videoList) > 0)
		@foreach($videoList as $v)

			Title: <a href="{{ URL::to('watch/'. $v->id) }}"> {{ $v->title }} </a> <br>
			By: <a href="{{ URL::to('user/'. $v->username) }}">{{ $v->username }}</a><br><br>

		@endforeach
	@endif
@stop

