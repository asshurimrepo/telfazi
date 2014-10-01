@if( count( $videos ) > 0 )
	@foreach( $videos as $i=>$v )
		<div class="row">
			<div class="col-md-3 col-xs-12 col-sm-6 entity">
				<div class="vidThumb">
					<div style="background: url({{ $v->getThumbnail() }}) no-repeat center; 
					background-size:cover;">
					<a href="{{ URL::to('watch/'.$v->id) }}">
					  <img src="{{ asset('assets/img/whitespace.png') }}" class="hover playarrow-ver ">
					</a>	
					</div>
					<span class="burb"><a href="{{ URL::to('watch/'.$v->id) }}">
						{{ $v->title }}
					</a></span>
					<span class="date">{{ date('F d Y', strtotime( $v->created_at )) }}</span>
					<span class="views"><em>{{ $v->views()->count() }}</em> views</span>
		        </div>
			</div>
		</div>
		
		@if($i%6 == 5)  
			<div class="col-md-12"></div>	 
		@endif
	@endforeach 
@else
	<div class="alert alert-warning"><b> <i class="glyphicon glyphicon-warning-sign"></i> No Videos found </b></div>
@endif