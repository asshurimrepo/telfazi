<?php
//initials
$columnClass = 'col-md-2 col-sm-4 col-xs-6'; //default column classes
if( isset($column_class) && $column_class )
	$columnClass = $column_class;
?>

<div class="{{ $columnClass }} listitem" style="padding: 2px;" id="video_item_{{ $v->id }}">
<a href="{{ $v->gotoUrl() }}" class="featvid darken">
	<div class="fsmall" style="background: url({{ $v->getThumbnail() }}) no-repeat center; background-size:cover; background-color:black">

	@if( isset( $disable_caption ) && $disable_caption == true)

	@else
		<div class="vid-caption" >
			<h5 class="title"><b>
				@if( isset($is_livestream) && $is_livestream )
					{{ str_limit($v->sub_name, 80, '') }}
				@else
					{{ $v->getTitle(80) }}
				@endif

			</b></h5>
			@if($v->getViews() > 0 )
				<div class="views pull-left">{{ $v->getViews() }} views</div>
			@endif

			<div class="pull-right">
				{{ $v->id }} &nbsp;
				{{ $v->categoryName() }}


				@if(isset( $enable_dislike ) && $enable_dislike)
					<a href="#" class="btn-dislike" id="{{$v->id}}" data-original-title="Dislike">
						<i class="fa fa-thumbs-down" id="n_dislikes"></i></a>
				@endif

				@if(isset( $enable_remove ) && $enable_remove)
					<a href="#" class="btn-video-playlist-remove"
						id="video_{{ $v->id }}"
						playlist="{{ $p->id }}">
						<i class="fa fa-trash-o"></i>
					</a>
				@endif


			</div>
		</div>
	@endif

	<img src="{{ asset('assets/img/vidspaces.png') }} " class="img-responsive">
	</div>
</a>

</div>