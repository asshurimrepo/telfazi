<div class="row recommended ">
	<div id="categories">
	@foreach( $channels as $c )
	<div class="col-md-2 col-xs-12 col-sm-6 entity">
		<figure>
			<div class="vidThumb ">
				<div style="background: url({{ $c->getThumbnail() }}) no-repeat center; 
				background-size:cover;">
				    <a href="{{ URL::to('channel/'.$c->id) }}">
				        <img src="{{ asset('assets/img/vidspaces.png') }}">
				    </a>
				</div>
				<div class="separator-space-xsm"></div>
				<div class="text-left">
					<span class="burb"><a href="{{ URL::to('channel/'.$c->id) }}">{{ $c->channelName() }}</a></span>
				</div>
			</div>
		</figure>
		</div> 
	@endforeach
	</div>
</div>
