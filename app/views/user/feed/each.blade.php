<div class="feed-name">
	<a href="{{ URL::to('user/'.$username) }}">
		<b>
		
		@if($feed->user->id == Auth::user()->id)
			{{ $isViewing ? $feed->uname() : 'You' }}
		@else 
			{{ $feed->uname() }}
		@endif	
		
		</b>
	</a>
</div> 
<div class="feed-content">
@if($feed->type->type_name == 'Playlist')
	<?php
	$playlist = VideoPlaylist::find($feed->activity_id);

	if($playlist && $playlist->video){
		$video 			= $playlist->video;

		$plist 			= $playlist->playlist;

		?>
		
			<span>
				have added  <a href="{{ URL::to('watch/'.$video->id) }}">{{ $video->title }}</a> to <a href="{{ URL::to('mytv/play/'.$plist->id) }}">{{ $plist->playlist_name }}</a> 
			</span>
			<span class="date">{{ date('F d Y h:i a', strtotime( $feed->created_at )) }}</span>
			
		<?php
	}?>
@endif

@if($feed->type->type_name == 'Like')
	<?php $like = VideoLike::find($feed->activity_id) ?>
	
	@if( $like && $like->video)
		<?php $video = $like->video; ?>
		have just liked <a href="{{ URL::to('watch/'.$video->id) }}">{{ $video->title }}</a>
				
		<span class="date">{{ date('F d Y h:i a', strtotime( $feed->created_at )) }}</span>
	@endif
@endif

@if($feed->type->type_name == 'Video')
	<?php $video = Video::find($feed->activity_id); ?>

	@if($video)
		<div class="row">
			<div class="col-md-12">
				<div class="note">posted a new video</div> 
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 col-xs-6 entity">
				<div class="vidThumb">
					<div style="background: url({{ $video->getThumbnail() }}) no-repeat center; 
						background-size:cover;">
						<a href="{{ URL::to('watch/'.$video->id) }}">
						  <img src="{{ asset('assets/img/whitespace.png') }}" 
						  class="hover playarrow-ver">
						</a>
					</div>
				</div>
			</div>
			<div class="col-md-9 col-xs-6" style="margin:0; padding:0;">
				<div class="vidThumb ">
					<span class="burb">{{ $video->title }}</span>
					<span class="date">{{ date('F d Y h:i a', strtotime($video->created_at) ) }}</span>
					<span class="views"><em>{{ $video->views()->count() }}</em> views</span>
					<span class="description"> {{ $video->getDescription() }}</span>
				</div>

			</div>
		</div>
	@endif
@endif


@if($feed->type->type_name == 'Post')
	<?php $post = Post::find($feed->activity_id); ?>

	@if($post)
		<span>{{$post->content}}</span>

		<span class="date">{{ date('F d Y h:i a', strtotime( $feed->created_at )) }}</span>
	@endif
@endif



@if($feed->type->type_name == 'Subscribe')
	<?php $subscribe = ChannelSubscribe::find($feed->activity_id);
	if($feed->content){
		$content = json_decode($feed->content);

		$sub = $content->subscribed;
	}

	?>

	@if($subscribe && isset($subo))
		@if($subscribe->userChannel)

		@endif
		{{ $sub ? 'subscribed' : 'unsubscribed'}} to 
		<a href="{{ URL::to('channel/'.$subscribe->channel_id)}}">
		@if($subscribe->userChannel)
			{{ $subscribe->userChannel->channelName() }} Channel
		@endif
		</a>

		<span class="date">{{ date('F d Y h:i a', strtotime( $feed->created_at )) }}</span>
	@endif
@endif
</div>