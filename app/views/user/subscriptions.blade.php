@extends('layouts.alphaprofile')

@section('content')

<div class="row vidlist">
               
  @if(count($subscriptions) > 0 )
    @foreach( $subscriptions as $s )
    	@if($s->userChannel)
    		<?php $c = $s->userChannel ?>
      		@include('layouts.home.carousel.chansmall', array('c' => $c, 'enable_unsubscribe' => true))
    	@endif
    @endforeach
  @endif
  
</div>

{{-- @include('channel.lists.subscriptions')	--}}

@stop

