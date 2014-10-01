<?php $min = 4?>
    @if( $counter < $min )
      @if($counter%$max == 0)
        <div class="lstream-box1 boxy">
      @endif

        @include('layouts.home.carousel.vidsmall', array('v'=>$v))

      @if($counter%$min == $min-1 || ($counter+1 == $streams->count()))
        </div>
      @endif
    @else
      <?php $mil = 3; ?>
      @if($iterator%$mil == 0)
        <div class="lstream-box2 boxy">
      @endif

        @if($iterator == 0)
          @include('layouts.home.carousel.vidBig', array('v'=>$v))
        @else
          @include('layouts.home.carousel.vidsmall', array('v'=>$v))
        @endif 

      

      @if($iterator%$mil == $mil-1 || ($iterator+1 == $streams->count()))
        </div>
      @endif

      <?php $iterator++; ?>
    @endif



<!-- <div class="item active"> -->
    <!-- <div class="lstream-box1 boxy">
  <a href="#" class="featvid darken">
    <div class="fsmall" style="background: url({{ asset('assets/img/vidconsmall.jpg') }}) no-repeat center; background-size:cover;">

      <img src="{{ asset('assets/img/vidspaces.png') }} " class="img-responsive">
      <div class="bottomleft">
        <p class="title">(text to appear at the bottom)</p>
        <p class="views">16, 087 views</p>
      </div>
    </div>
  </a>

  <a href="#" class="featvid darken">
    <div class="fsmall" style="background: url({{ asset('assets/img/vidconsmall.jpg') }}) no-repeat center; background-size:cover;">

      <img src="{{ asset('assets/img/vidspaces.png') }} " class="img-responsive">
      <div class="bottomleft">
        <p class="title">(text to appear at the bottom)</p>
        <p class="views">16, 087 views</p>
      </div>
    </div>
  </a>

  <a href="#" class="featvid darken">
    <div class="fsmall" style="background: url({{ asset('assets/img/vidconsmall.jpg') }}) no-repeat center; background-size:cover;">

      <img src="{{ asset('assets/img/vidspaces.png') }} " class="img-responsive">
      <div class="bottomleft">
        <p class="title">(text to appear at the bottom)</p>
        <p class="views">16, 087 views</p>
      </div>
    </div>
  </a>

  <a href="#" class="featvid darken">
    <div class="fsmall" style="background: url({{ asset('assets/img/vidconsmall.jpg') }}) no-repeat center; background-size:cover;">

      <img src="{{ asset('assets/img/vidspaces.png') }} " class="img-responsive">
      <div class="bottomleft">
        <p class="title">(text to appear at the bottom)</p>
        <p class="views">16, 087 views</p>
      </div>
    </div>
  </a>
</div> -->



<!-- <div class="lstream-box2 boxy">
  <a href="#" class="featvid darken">
    <div class="fbig" style="background: url({{ asset('assets/img/vidconbig.jpg') }}) no-repeat center; background-size:cover; height: 243px; " >

      <img src="{{ asset('assets/img/vidspaceb.png') }} " class="img-responsive">
      <div class="bottomleft">
        <p class="title">(text to appear at the bottom)</p>
        <p class="views">16, 087 views</p>
      </div>
    </div>
  </a>

  <a href="#" class="featvid darken">
    <div class="fsmall" style="background: url({{ asset('assets/img/vidconsmall.jpg') }}) no-repeat center; background-size:cover;">

      <img src="{{ asset('assets/img/vidspaces.png') }} " class="img-responsive">
      <div class="bottomleft">
        <p class="title">(text to appear at the bottom)</p>
        <p class="views">16, 087 views</p>
      </div>
    </div>
  </a>

  <a href="#" class="featvid darken">
    <div class="fsmall" style="background: url({{ asset('assets/img/vidconsmall.jpg') }}) no-repeat center; background-size:cover;">

      <img src="{{ asset('assets/img/vidspaces.png') }} " class="img-responsive">
      <div class="bottomleft">
        <p class="title">(text to appear at the bottom)</p>
        <p class="views">16, 087 views</p>
      </div>
    </div>
  </a>
</div> -->



<!-- end item -->