<?php
$singleTag = '';
if( $video->tags->count() > 0){
	$singleTag = $video->tags()->first()->name;
}
?>
<div id="playerrxwtYJnCGzFb">
       Please <a href="http://get.adobe.com/flashplayer/" >install flash</a> to watch the video or download it from <a href="{{ $video->getVideoURL() }}">here</a>

</div>

<script type="text/javascript">
var base_domain = "{{ URL::to('/') }}";
var video_url = "{{ $video->getVideoURL() }}";
var mobile_video_url = '{{ $video->getMobileURL() }}';
var video_tag = "{{ $singleTag }}";
var video_thumbnail = "{{ $video->getThumbnail() }}";

if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
	jwplayer("playerrxwtYJnCGzFb").setup({
	file: mobile_video_url,
	image: video_thumbnail,
	ga: {},
	fallback: false,
	width: '100%',
	height: "550",
	primary: 'HTML5',
	stretching: 'exactfit',
	logo: {
			file: '{{ asset("assets/img/vidorabia-text.png")}}',
			position: 'bottom-right',
			margin: '12'
			//link: 'http://example.com'
	    }

	});
}else{
	jwplayer('playerrxwtYJnCGzFb').setup({
		file: video_url,
		image: video_thumbnail,
		autostart:true,
		ga: {},
		fallback: false,
		width: '100%',
		height: "550",
		primary: 'flash',
		stretching: 'exactfit',
		logo: {
			file: '{{ asset("assets/img/vidorabia-text.png")}}',
			position: 'bottom-right',
			margin: '12'
			//link: 'http://example.com'
	    },
		advertising: {
		client: 'vast',
		tag: 'http://www.adotube.com/kernel/vast/vast.php?omlSource=http://www.adotube.com/php/services/player/OMLService.php?avpid=i24YhWD&ad_type=pre-rolls&vpaid=1&rtb=0&platform_version=vast20as3&publisher=www.telfazi.com&title='+"{{ $video->title }}"+'&description=[VIDEO_DESCRIPTION]&videoURL&http_ref='+video_url,
		skipoffset: '2'
		}
	});
} 
</script>

