@if( count( $subscriptions ) > 0 )
	<table class="table table-striped" id="vidtable">
		<tbody>
			@foreach( $subscriptions as $s )

				<tr>
				<td style="width:60%">
					<a href="#">
						<img src="{{ $s->userChannel->getThumbnail() }}" class="pull-left" width="211" height="118" style="margin-right:5px">
					</a>

					<span class="burb-sm">
						<a href="{{ url('channel/'.$s->userChannel->channel_id) }}">
							{{ $s->userChannel->channelName() }}
			        	</a>
			    	</span>
					
				</td>

				@if($isViewing == false)
				<td>
					<div class="btn-group pull-right">
					  	<form action="{{ URL::to('mytv/subscriptions') }}" method="post">
					  		<input type="hidden" name="subscription" value="{{ $s->id }}"> 
					  		<button type="submit" title="" class="btn btn-default tips btn-sm btn-dislike" id="" data-original-title="Dislike">
								<b>unsubscribe</b> 
							</button>
					  	</form>
					</div>
				</td>
				@endif
			@endforeach
		</tbody>
	</table>
@else
	<div class="alert alert-warning"><b> <i class="glyphicon glyphicon-warning-sign"></i> No Subscriptions Found. </b></div>
@endif