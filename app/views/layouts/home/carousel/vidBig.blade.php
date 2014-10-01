<div class="col-md-4 col-sm-4 col-xs-6 listitem" style="padding: 0px 3px 8px 0px">
<a href="{{ $v->gotoUrl() }}" class="featvid darken">
	<div class="fbig" style="background: url({{ $v->getThumbnail() }}) no-repeat center; background-size:cover;  background-color:black" >
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
		<img src="{{ asset('assets/img/vidspaceb.png') }} " class="img-responsive">
		{{--
		<div class="bottomleft">
        			@if($v->getViews() > 0 )
        			<p class="title"><b>
        				{{ $v->getTitle(80) }}

        			</b></p>
        			<p class="views">
        				{{ $v->getViews() }} views
        			</p>
        			@else
        				<p class="title lowline">
        					@if( isset($is_livestream) && $is_livestream )
        						{{ str_limit($v->sub_name, 80, '') }}
        					@else
        						{{ $v->getTitle(80) }}
        					@endif
        				</p>
        			@endif
        		</div>
		--}}
	</div>
</a>
</div>