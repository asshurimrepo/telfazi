@if( count( $videos ) > 0 )
		<div class="row vidlist" id="likedVideos">
		@foreach( $videos as $i=>$v )
			<div id="video_{{ $v->id }}" class="videoitem">
			
			@include('layouts.home.carousel.vidsmall', array('v' => $v, 'enable_dislike' => true ))
			
			</div>
		@endforeach
		</div>
@else
	<div class="alert alert-warning">
		<b><i class="glyphicon glyphicon-warning-sign"></i> 
		No Videos found</b>
	</div>
@endif
<script type="text/javascript">
	$('.btn-dislike').click(function(e){
		e.preventDefault();
		var video_id = this.id; 

		
		$.post('{{ URL::to('likes') }}',{ status:'unlike', video_id: video_id }, function( data ){
			$('#video_'+video_id).fadeOut( {{ $trans_dura }} , function() {
		        $(this).remove();
		    });	
		});
	});
</script>