
@if( $feeds->count() > 0)
	@foreach( $feeds as $feed)
		<?php
			$username		= $feed->user->username;	
		?>
		<div class="row activity-feed">

			@if(Session::get('lang') == 'ar')
				<div class="separator-space"></div>
				<div class="col-md-11 ">

					@include('user.feed.each', array( 'feed' => $feed ))

				</div>
				<div class="col-md-1">
					<div class="vidThumb ">
	                    <div class="uicon" style="background: url({{ $user->getThumbnail() }}) no-repeat center; 
	                    background-size:cover; width:39px; height:39px;">
	                        <a href="#">
	                            <img src="{{ asset('assets/img/profile_cover.png') }}">
	                        </a>
	                    </div>
	                </div>
				</div>
			@else 
				<div class="col-md-1">
					<div class="vidThumb ">
	                    <div class="uicon" style="background: url({{ $user->getThumbnail() }}) no-repeat center; 
	                    background-size:cover; width:39px; height:39px;">
	                        <a href="#">
	                            <img src="{{ asset('assets/img/profile_cover.png') }}">
	                        </a>
	                    </div>
	                </div>
				</div>
				<div class="col-md-11 ">

					@include('user.feed.each', array( 'feed' => $feed ))

				</div>
			@endif
			
		</div>
		<div class="separator-line"></div> 

	@endforeach

@else
	<div class="alert alert-warning">
		<b> <i class="glyphicon glyphicon-warning-sign"></i> No activity feeds available </b> 
	</div>
@endif

