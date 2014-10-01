@extends('layouts.alphaprofile')

@section('content')
		
<div class="row vidlist">
	@if( count( $playlist ) > 0 )
		@foreach( $playlist as $p )
		<?php $v = $p->video; ?>	
		
			@if($v)
				@include('layouts.home.carousel.vidsmall', array('v' => $v, 'enable_remove' => true))
			@endif

		@endforeach
	@endif
</div>

<script type="text/javascript">
$(function(){
	$('.btn-video-playlist-remove').click(function(e){
		e.preventDefault();
		var split = this.id.split('_');
		var playlist_id = $(this).attr('playlist');
		var video_id = split[1];

		$.ajax({
			url: "{{ url('mytv/play') }}",
			type:"POST",
			data: { remove : playlist_id, video_id: video_id },
			success: function( data ){
				$('#video_item_'+video_id).fadeOut( {{ $trans_dura }} , function() {
				    $(this).remove();
			    });	
			}
		});
	});
});
</script>
@stop

