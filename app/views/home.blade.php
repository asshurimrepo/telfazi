@extends('layouts.alpha')


@section('content')

  @include('layouts.home.socialbtns')

  @include('layouts.frag.feeder_featured', array('videos' => $featured))

  <div class="row">
    <div class="col-md-12">
      <div class="blur-border">
        <img src="{{ asset('assets/img/blurborder.jpg') }}">
        <p>
          @if(Session::get('lang') == 'ar')
          <b>{{ Lang::get('lang.live_streaming')}}</b>
          @else
          <span class="empha">Live</span> Streaming 
          @endif
        </p>

      </div>
    </div>
  </div>
  
  @include('layouts.frag.feeder_stream')
  

  
  <div class="separator-space"></div>

  <div class="row">
    <div class="col-md-3">
      <div class="btn btn-orange btn-block"> {{ Lang::get('lang.recommended')}} </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-8">
      <div class="line-separator"></div>

      @include('layouts.frag.feeder_recommend', array('videos' => $recommended) )

      <div style="margin-bottom:50px"></div>
      @if(Session::get('lang') == 'ar')
      <b>{{ Lang::get('lang.most_viewed')}}</b>
      @else
      <div class="feeder-header">MOST <b>VIEWED</b></div>   
      @endif
      
 
      @include('layouts.frag.feeder_mostviewed', array('videos' => $mostViewed) ) 

      <div class="separator-space"></div>

    </div>
    <div class="col-md-4">
      <div class="line-separator"></div>
      <div class="row recommended">
        <div id="homempu">

          @include('components.mpu')
        
        </div>
        <div class="separator-space-sm"></div>
      </div>


      <div class="row">
        <div class="col-md-12 ">
          <div class="pull-right ">
            <a href="{{ url('channels') }}" class="btn btn-default btn-xs"><i class="fa fa-play"></i> 
              {{ Lang::get('lang.see_all')}}
            </a>
          </div>

          @if(Session::get('lang') == 'en')
      <div class="feeder-header">Popular <b>Channels</b></div>
      @else 
      <b>{{ Lang::get('lang.popular_channels')}}</b>
      @endif
          <div class="separator-space-xsm"></div>
        </div>
      </div>
      
      @include('layouts.frag.feeder_channels', array('channels' => $channels))

    </div>
  </div>
@stop


