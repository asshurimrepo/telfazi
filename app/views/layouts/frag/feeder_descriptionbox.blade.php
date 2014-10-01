<!-- Description Area -->
<div class="row">
	<div class="col-md-12">
		<div class="video-detail">
			<!-- <span class="burb">{{ $video->getTitle() }}</span> -->
			<span class="date">{{ $video->getCreatedAt('F d, Y') }}
				@if( $video->getDisplayName() )
					|
				@endif 
				<a href="{{ URL::to('user/' . $video->getDisplayName() ) }}">
					{{ $video->getDisplayName() }}</a> 
			</span>
			<span class="view">
				<em>{{ $video->getViews() }}</em>  {{ Lang::get('lang.views') }}
			</span>
		</div>
		<div class="video-respo">
			<ul>
				<li>
					@if( Auth::check() )

						<div class="btn-group">
						  	<button type="button" title="{{ $video->hasLiked() ? 'Unlike' : 'Like' }}" class="btn btn-dark  tips <?php echo $video->hasLiked() ? 'btn-warning liked' : 'btn-dark' ?> "
						  		id="like">
						  		<span class="glyphicon glyphicon-thumbs-up"></span> <b id="n_likes"> {{ $video->likes() }}</b> 
						  	</button>
						  	<button type="button" title="{{ $video->hasDisliked() ? 'Un-dislike' : 'Dislike' }}" class="btn btn-dark tips {{ $video->hasDisliked() ? 'btn-danger disliked' : 'btn-dark' }}"
						  	 	id="dislike">
								<span class="glyphicon glyphicon-thumbs-down"></span> <b id="n_dislikes">{{ $video->dislikes() }}</b> 
							</button>
						</div> 

					@else

						<div class="btn-group">
						  	<button type="button" title="Likes" class="btn btn-dark tips" data-toggle="modal" data-target="#loginModal">
						  		<span class="glyphicon glyphicon-thumbs-up"></span> <b id="n_likes"> {{ $video->likes() }}</b> 
						  	</button>
						  	<button type="button" title="Dislikes" class="btn btn-dark tips" data-toggle="modal" data-target="#loginModal">
								<span class="glyphicon glyphicon-thumbs-down"></span> <b id="n_dislikes">{{ $video->dislikes() }}</b> 
							</button>
						</div> 

					@endif
				</li>
			</ul>

			<!-- <div class="sharingbtns pull-right">
				<span class='st_sharethis_large' displayText='ShareThis'></span>
				<span class='st_facebook_large' displayText='Facebook'></span>
				<span class='st_twitter_large' displayText='Tweet'></span>
			</div> -->
		</div>
	</div>
	</div>
	<div class="col-md-5">
		
</div>
<!-- Description Area -->

<div class="clearfix separator-space-sm"></div>




<!-- Video Description Tabs -->
<div class="row">
	<div class="col-md-12">
		<div class="video-tab tabs-right ">
			<ul class="nav nav-tabs tabs-right" id="myTab">
				<li class="active"><a href="#desc" class="btn btn-dark" data-toggle="tab">
					{{ Lang::get('lang.description') }}</a></li>
				<li><a href="#addto" class="btn btn-dark" data-toggle="tab">
					{{ Lang::get('lang.add_to') }}</a></li>
				<li><a href="#report" class="btn btn-dark" data-toggle="tab">
					{{ Lang::get('lang.report') }}</a></li>
			</ul>
			@if( empty($video->description))
				<?php $video->description = 'No Description Available'; ?>
			@endif
			
			<div class="description tab-content tabs-right">
				
				<div class="tab-pane active" id="desc"> 
					{{ $video->getDescription() }}
				</div>


				<div class="tab-pane" id="addto">
					@if( Auth::check() )
						<div id="playlist">
							<!-- Request Playlists -->
						</div>
					@else
						<div class="text-center">You are not logged in. 
							<a href="#{{ URL::to('login') }}" data-toggle="modal" data-target="#loginModal" class="btn btn-info btn-xs">Sign in</a>  
						</div>
					@endif
				</div>
				

				<div class="tab-pane" id="report">
					@if( Auth::check() )
						<div id="reportvideo">
							<!-- Request Report Page -->
						</div>
					@else
						<div class="text-center">You are not logged in. 
							<a href="#{{ URL::to('login') }}" data-toggle="modal" data-target="#loginModal" class="btn btn-info btn-xs">Sign in</a>  
						</div>
					@endif
					
				</div>
				<div class="separator-space-xsm"></div>
			</div>
		</div>
	</div>
</div>
<!-- Video Description Tabs -->





<script type="text/javascript">

	$(function(){
		$(document).ready(function () {
			var disableLike = false;
			var disableDislike = false;

		     $(".tips").tooltip({container:'body'});


			
			//Add to Tab
			$('#playlist').load("{{ URL::to('addToList') }}", { video_id: "{{ $video->id }}" },  function(){});

			$('#reportvideo').load("{{ URL::to('report') }}", { video_id: "{{ $video->id }}" },  function(){});


			// Like and Dislike
			$('#like').click(function(e){
				console.log(' working working');
				$(this).toggleClass('btn-warning liked');

				if($(this).hasClass('liked')){

					// if has disliked
					if($('#dislike').hasClass('disliked')){
						$('#dislike').click();
					}

					$(this).tooltip('hide')
					          .attr('data-original-title', 'Unlike')
					          .tooltip('fixTitle');

					$.post('{{ URL::to('likes') }}',{status:'like', video_id:"{{ $video->id }}" });

				}else{
					$(this).tooltip('hide')
					          .attr('data-original-title', 'Like')
					          .tooltip('fixTitle');

					$.post('{{ URL::to('likes') }}',{status:'unlike', video_id:"{{ $video->id }}" });

				}
			});

			$('#dislike').click(function(e){
				$(this).toggleClass('btn-danger disliked');

				if($(this).hasClass('disliked')){

					// if has liked
					if($('#like').hasClass('liked')){
						$('#like').click();
					}

					$(this).tooltip('hide')
					          .attr('data-original-title', 'Dislike')
					          .tooltip('fixTitle');

					$.post('{{ URL::to('likes') }}',{status:'dislike', video_id:"{{ $video->id }}" });

				}else{
					$(this).addClass('btn-dark');

					$(this).tooltip('hide')
					          .attr('data-original-title', 'Un-dislike')
					          .tooltip('fixTitle');

					$.post('{{ URL::to('likes') }}',{status:'un-dislike', video_id:"{{ $video->id }}" });

				}

			});


			setInterval(function(){
					$.post('{{ URL::to('likes') }}',{status:'get', video_id:"{{ $video->id }}" }, function(data){
						$("#n_likes").html(data.likes);
						$("#n_dislikes").html(data.dislikes);
					});
			}, 2000);


		     


		});
	});

</script>