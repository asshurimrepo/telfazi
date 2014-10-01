<div class="list-group">
@foreach( $playlists as $play)
	<?php

	$active = ''; $disable = "novalue";
	if($video->id == $play->video_id){
		$active = "active";
		$disable = "disabled";
	}
	?>
	<a href="#" class="list-group-item addto {{ $active }}" data="{{ $play->id }}" 
		id="{{ $play->playlist_name }}" response="{{ $disable }}">
	    {{ $play->playlist_name }}<span class="badge badge_{{ $play->id }}"> {{ $play->count }} </span>
  	</a>
@endforeach
</div>

<script type="text/javascript">
//Add to Tab
	$('.addto').click(function(e){
		e.preventDefault();

		var plistName = this.id;
		var plistID = $(this).attr("data");
		var videoID = "{{ $video->id }}";
		var channelID = "{{ $video->channel->channel_id }}";
		var disabled =  $(this).attr("response");


		if(disabled != 'disabled'){
			$.ajax({
				url: "{{ URL::to('addto') }}",
				data: { playlist_id: plistID, channel_id: channelID, video_id: videoID  }
			}).done(function( response ){
				
				//Add to Tab
				$('#playlist').load("{{ URL::to('addToList') }}", { video_id: "{{ $video->id }}"},  function(){});
			});
		}
	});
</script>