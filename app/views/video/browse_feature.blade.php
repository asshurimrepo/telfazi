<div class="row">
	<div class="col-md-8" style="height: 550px">
		@include('video.videoplayer', array('video' => $video))
	</div>

	<div class="col-md-4">
		<div class="browse-box">
			<div>
				<h2><a href="{{ $video->gotoUrl() }}">{{ $video->getTitle(60) }}</a></h2>
				<p class="text-muted">{{ $video->getCreatedAt('F d, Y') }}</p>
				<ul class="list-inline list-unstyled">
				    <li><b>{{ $video->getViews() }}</b> views</li>
				    <li>likes <b>{{ $video->likes() }}</b></li>
				    <li>dislikes <b>{{ $video->dislikes() }}</b></li>
				</ul>
				<p style="margin-top: 20px;">Description: <br/>
				{{ $video->getDescription(98) }}</p>

				{{-- Go to www.addthis.com/dashboard to customize your tools --}}
                <div class="addthis_sharing_toolbox"></div>

                <div class="separator-space-sm"></div>
				
			</div>
		

			@include('components.mpu')
		</div>
	</div>
</div>
<div class="separator-space-sm"></div>