<div class="col-md-8">

  @include('video.categories.videofeedslider', array('title'=>'Recent', 'v_feed'=>$recentVideos, 'vid'=>'recent'))
  @include('video.categories.videofeedslider', array('title'=>'Most Viewed', 'v_feed'=>$mostViewed, 'vid'=>'mostviewed'))
  @include('video.categories.videofeedslider', array('title'=>'Popular', 'v_feed'=>$popular, 'vid'=>'popular'))


  @if( count($categoryVideos) > 0 )
  	@foreach ( $categoryVideos as $i => $c )
    <?php $category = $c->category_name?>
    @if(count($c->videos) > 0)

        @include('video.categories.videofeedslider', array('title'=>$category, 'v_feed'=>$c->videos, 'vid'=>'cat_'.$i))

       @endif
  	@endforeach
  @endif

</div>

<div class="col-md-4" id="recommended">
  
  <div id="advertise-mpu">
      <img src="{{ asset('assets/img/mpu.jpg') }}" />
    </div>
  @include('video.categories.recommended', array('title'=>'Recommended Videos', 'feed'=>$recommended))  
    
</div>

<script type='text/javascript'>
  
  $(document).ready(function(){

      $(".tips").tooltip({container:'body'});

  });

</script>