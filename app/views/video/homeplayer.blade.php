
<?php
$url = '';
$url = $lucky_video['url'];
$lucky_video = Video::findOrFail($lucky_video['id']);

$tags = $lucky_video->getTags();

$singleTab =  count($tags) > 0 ? $tags[array_rand($tags)] : "";


?>
<!-- check if video is not null -->
<!-- Video Frame -->
  <div id="video-frame"> <!-- video frame start -->
    <div class="container"> <!-- container start -->
      <div class="row ">
        <div class="col-md-8 no-space">
         <div class="video-header "><h2>{{ $lucky_video['title'] }}</h2></div>
          <div id="video-control">
            <div id="playerrxwtYJnCGzFb">
              {{-- <a href="{{ $video->url }}">Watch Video</a> --}}
            </div>
          </div>
        </div>

        <div class="col-md-4 no-space">
          <div class="video-header gradient-black "><h2>Related Videos</h2></div>
          <div class="video-group scrollbox"> <!-- video group start --> 
            @if( count($videoList) > 0 && $lucky_video)

              @foreach( $lucky_video->relatedVideos() as $v )

                <?php

                // limit the characters of the description
                $max = 100; 
                if($v->description){

                  if( strlen($v->description) > $max ){

                    $v->description = Util::split_words($v->description, $max, '...');

                  }
                }
                ?>
                <div class="video-box">
                  <div class="video-desc">
                    <h2><a class="video-link" href="{{ URL::to('watch/'.$v->id) }}">{{ $v->title }}</a></h2>

                    @if ($v->description) 
                      <span>{{ $v->description }}</span><br>
                    @endif

                    by <span class="video-author"><a href="{{ URL::to('user/'. $v->user()->username) }}">{{ $v->user()->display_name ? $v->user()->display_name : $v->user()->username }}</a></span><br>
                    <span class="video-time"> {{ Util::getDuration( $v->video_duration ) }} </span>
                  </div>
                  <div class="video-thumb"><img src="{{ Video::find($v->id)->getThumbnail() }}" alt="image" /></div>
                  <div class="clearfix"></div>
                </div>
              @endforeach
            @endif
        </div>
      <div class="clearfix"></div>
      </div>
    </div>
  </div>  <!-- container end -->
</div><!-- video frame end -->
<!-- Video Frame -->

@section('jwplayer')

  startPlayer("{{ $url }}", false);  


  function startPlayer( url, isStart ){
          var duration = 0;

          // scroll back to top
          $('html,body').animate({ scrollTop: 0 }, 'fast');


         /* jwplayer("myElement").setup({
              autostart: true,
              file: url,
              width: 640,
              height: 360,
              advertising: {
                client: 'vast',
                tag: "{{ asset('assets/vast.xml') }}",
                skipoffset: '2'
              }
          }); */


          var base_domain = "{{ URL::to('/') }}";
          var video_title = "{{ $lucky_video['title'] }}";
          var video_url = "{{ $url }}";
          var video_tag = "{{ $singleTab }}";
          


          jwplayer('playerrxwtYJnCGzFb').setup({
            autostart: true,
            file: url,
            image: '{{ asset("assets/vidthumbs/".$lucky_video["thumbnail"] )}}',
            fallback: false,
              width: 640,
            height: 360,
              stretching: 'exactfit',
              //primary: 'flash',
              logo: {
              file: '{{ asset("assets/img/vidorabia-text.png") }}',
              position: 'bottom-right',
              margin: '12'
              //link: 'http://example.com'
              },
              advertising: {
                client: 'vast',
                //tag: "{{ asset('assets/vast.xml') }}",
                
                tag: "http://www.adotube.com/php/services/player/OMLService.php?avpid=oRYYzvQ&platform_version=vast20&ad_type=linear&groupbypass=1&HTTP_REFERER="+video_url+"&video_identifier="+base_domain+","+video_title+","+video_tag+","+video_url+" ",
                skipoffset: '2'
             }
          });
        }
@stop
