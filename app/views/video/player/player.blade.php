<script src="{{ asset('assets/js/jwplayer/jwplayer.js') }}"></script>

<div id="playerrxwtYJnCGzFb" >
	<a href="{{ $video->url }}">Watch Video</a>
</div>
<script type="text/javascript">

//JWPlayer
	startPlayer("{{ $video->url }}", false);  


	function startPlayer( url, isStart ){
		var duration = 0;

		// scroll back to top
		$('html,body').animate({ scrollTop: 0 }, 'fast');

		var base_domain = "{{ URL::to('/') }}";
		var video_title = "{{ $video->title }}";
		var video_url = "{{ $video->url }}";

		jwplayer('playerrxwtYJnCGzFb').setup({
			autostart: true,
			file: url,
			image: '{{ asset("assets/vidthumbs/".$video->getThumbnail() )}}',
			fallback: false,
		    width: 640,
			height: 360,
		    stretching: 'exactfit',
		    //primary: 'flash',
		    logo: {
				file: '../assets/img/vidorabia-text.png',
				position: 'bottom-right',
				margin: '12'
				//link: 'http://example.com'
		    },
		    advertising: {
			    client: 'vast',
			    //tag: "{{ asset('assets/vast.xml') }}",
		    	tag: "http://www.adotube.com/php/services/player/OMLService.php?avpid=oRYYzvQ&platform_version=vast20&ad_type=linear&groupbypass=1&HTTP_REFERER="+video_url+"&video_identifier="+base_domain+","+video_title+",soccer,"+video_url+" ",
			    
			    skipoffset: '2'
		   }
		});
	}
</script>