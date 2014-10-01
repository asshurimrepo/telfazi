@if( count( $playlist ) > 0 )
	<table class="table table-striped" id="vidtable">
		<tbody>
			@foreach( $playlist as $p )	
				<tr>
					<td>
						<div class="vidThumb">
							<div style="background: url({{ $p->video->getThumbnail() }}) no-repeat center; 
								background-size:cover;">
								<a href="{{ URL::to('watch/'.$p->video->id) }}">
								  <img src="{{ asset('assets/img/whitespace.png') }}" class="hover playarrow-ver ">
								</a>
							</div>
						</div>
					</td>
					<td>
						<span class="burb-sm">
							<a href="{{ URL::to('watch/'.$p->video->id) }}">
				        		{{ $p->video->title }}
				        	</a>
				    	</span>
						<div class="description">{{ $p->video->description }}</div>
					</td>
					<td><div class="burb-sm">{{ $p->user->firstname .' ' . $p->user->lastname}}</div></td>
					<td><div class="burb-sm">{{ $p->video->video_duration ? $p->video->video_duration : '00:00'; }}</div></td>
					
					@if($isViewing == false)
					<td>
						<form action="{{ URL::to('mytv/play') }}" method="post">
						<div class="btn-group pull-right">
							<input type="hidden" name="remove" value="{{$p->id}}">
							<input type="hidden" name="video_id" value="{{ $p->video->id }}">
						  	<button type="submit" title="" class="btn btn-default tips btn-sm btn-dislike" data-original-title="Dislike">
								<span class="glyphicon glyphicon-trash"></span> <b id="n_dislikes">Remove</b> 
							</button>
						</div>
						</form>
					</td>
					@endif
				</tr>
			@endforeach 
		</tbody>
	</table>
@else
	<div class="alert alert-warning"><b> <i class="glyphicon glyphicon-warning-sign"></i> No Videos found </b></div>
@endif
