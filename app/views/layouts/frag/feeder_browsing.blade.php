@if(isset($type))
	@if( $type == 'search' )
		<div class="alert alert-danger" role="alert">
			<b>Search result found {{$videos->count()}} videos </b>
		</div>
	@endif
@endif

<div class="row recommended">

	@if( count($videos) > 0)
	<div id="browse_vids">
		<div class="col-md-12">
			<div class="row">
			@foreach( $videos as $i => $v )

				<div class="col-md-2 col-xs-6 col-sm-3 entity recommended" style="padding: 0 10px 0 10px;">
					<figure class="vidThumb" style="min-height:150px;">
						<div style="background: url({{ $v->getThumbnail() }}) no-repeat center; background-size:cover;" 
							class="pic-holder">
							<a href="{{ URL::to('watch/'.$v->id) }}">
								<img src="{{ asset('assets/img/whitespace2.png') }}" class="hover" width="100%">
							</a>
						</div>
						<div class="meta">
							<span class="head"><a href="{{ URL::to('watch/'.$v->id) }}">{{ $v->getTitle(30) }}</a></span>
						</div>
					</figure>
				</div>

				@if(($i+1)%6 == 0) 
					<div class="col-md-12"></div>
				@endif
			@endforeach
			</div>	
		</div>
	</div>

	@if( count($videos) >= 20 )
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<button  type="button" id="2" data-loading-text="Fetching..." 
				class="btn btn-block btn-default show_more">
			<b>{{ Lang::get('lang.show_more') }}</b> <!-- <span class="glyhpicon glyphicon-plus" ></span> -->
			</button>
		</div>
	</div>
	@endif


	@else 	
		<div class="alert alert-danger" role="alert">
			<b>Sorry! No videos found. </b>
		</div>
	@endif

</div>
<?php
if(!isset($category_id))
	$category_id = 0;
if(!isset($slug))
	$slug = '';

?>
<script type="text/javascript">
	$(function(){
		var page = 0;
		$('.show_more').click(function(){
			page = this.id;
			$.ajax({
				url:"{{ url('browse') }}",
				type:"post",
				data: { getLastPage: this.id, category_id: '{{ $category_id }}', filter : '{{ $slug }}' },
				cache: false,
				success: function( html ){
					var npage = parseInt(page) + 1;

					if(html){
						$('#browse_vids').append(html);
						$('.show_more').attr('id', npage);
					}else{
						
						$('.show_more').attr('disabled', 'disabled');
					}
					
				}
			});
		});
	});

</script>



