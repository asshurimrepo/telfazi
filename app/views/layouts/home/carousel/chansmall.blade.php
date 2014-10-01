<div class="col-md-2 col-sm-4 col-xs-6 listitem" style="padding: 2px;" id="video_item_1451">
  <a href="{{ URL::to('channel/'.$c->id) }}" class="featvid darken">
    <div class="fsmall" style="background: url({{ $c->getThumbnail() }}) no-repeat center; background-size:cover; background-color:black">

      <img src="{{ asset('assets/img/vidspaces.png') }} " class="img-responsive">
  
    </div>
  </a>
  <div class="vid-bottombar">
    <h5 class="title">
    	<b><a href="{{ URL::to('user/'.$c->user->username) }}">{{ $c->channelName() }}</a></b></h5>

  		@if(Auth::check() &&  Auth::user()->id != $c->user->id)
        @if(isset( $enable_unsubscribe ) && $enable_unsubscribe)
          @if($isViewing == false)
            <form action="{{ URL::to('mytv/subscriptions') }}" method="post">
                <input type="hidden" name="subscription" value="{{ $s->id }}"> 
                <button type="submit" title="" class="btn btn-dark btn-xs" id="">
                <b>unsubscribe</b> 
              </button>
              </form>
            @endif
        @endif

        @if(isset( $enable_subscription ) && $enable_subscription)
          <div class="subscribe" id="{{ $c->channel_id }}">

            @include('channel.lists.subscribe')
            
          </div>
        @endif
      @endif
    	
    </a>
  </div>
</div>