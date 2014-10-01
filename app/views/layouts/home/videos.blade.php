<?php
if(!isset($category_id))
	$category_id = 0;
if(!isset($slug))
	$slug = '';

?>
@if(isset($type))
	@if( $type == 'search' )
		<div class="alert alert-danger" role="alert">
			<b>Search result found {{$videos->count()}} videos </b>
		</div>
	@endif
@endif
<div class="boxy nopadd clearfix">
	
	@if( count($videos) > 0)
		<div id="browse_vids">
			<div class="row vidlist">

		@foreach( $videos as $i => $v )
			
			@include('layouts.home.carousel.vidsmall', array('v' => $v))
			
		@endforeach
			</div>
		</div>
	@else 	
		<div class="alert alert-danger" role="alert" id="error-message">
			<b>Sorry! No videos found. </b>
		</div>
	@endif

	<div id="error-message">
		<!-- Error Messages Here -->
	</div>

	<div class=""></div>
</div>

@if( count($videos) >= $perPage )
<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<button  type="button" id="2" data-loading-text="Fetching..."  style="margin-top: 40px;"
			class="btn btn-block btn-primary show_more">
		<b>{{ Lang::get('lang.show_more') }}</b>
	</div>
</div>
@endif

<form action="">
	<input type="hidden" id="category_id" data-value="{{ isset($category_id) ? $category_id : '' }}">
	<input type="hidden" id="tag_id" data-value="{{ isset($tag_id) ? $tag_id : '' }}">
	<input type="hidden" id="slug" data-value="{{ isset($slug) ? $slug : '' }}">
</form>

<script type="text/javascript">
	$(function(){
		var page = 0;

		$('.show_more').click(function(){
			page = this.id;
			$.ajax({
				url:"{{ url('browse') }}",
				type:"post",
				data: { getLastPage: this.id, 
					category_id: $('#category_id').data('value'),
					filter : $('#slug').data('value'),
					tag_id: $('#tag_id').data('value') 
				},
				cache: false,
				success: function( html ){
					var npage = parseInt(page) + 1;

					if(html){
						$('#browse_vids').append(html);
						$('.show_more').attr('id', npage);
					}else{
						$('#error-message').html('<div style="margin-top:40px"> <p class="text-center"> No videos found </p> </div>');

						$('.show_more').fadeOut('100');
					}
					
				}
			});
		});
	});

</script>




