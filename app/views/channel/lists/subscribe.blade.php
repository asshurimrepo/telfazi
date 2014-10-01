<?php
$subscribers = $c->subscribers()->where('subscribed', 1)->count();
if(Auth::check()){
	
	$sub = $c->subscribeBy(Auth::user()->id);
}
?>

@include('scripts.fblogin')

<span class="views">
	<a href="#" class="btn btn-dark btn-xs n_subscribe" id="{{ $c->channel_id }}" 
		data-toggle="modal" data-target="#loginModal">
		<i class="fa fa-caret-square-o-right"></i> &nbsp;
		@if( isset($sub) && $sub)
			@if($sub->subscribed)
				unsubscribe
			@else
				subscribe
			@endif
		@else
			subscribe
  		@endif
	</a>
	<div class="label label-default no_subs">
		<span>{{ $subscribers }}</span>
	</div> 
</span>
@include('layouts.others.loginmodal')