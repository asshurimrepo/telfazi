<div class="row recommended feeder-channels"> 
  @if(count($channels) > 0)
    @foreach($channels as $c)
      <div class="col-md-6 col-xs-6">
        <div class="channel">
          <img src="{{ asset('assets/img/logo.png') }}" width="100%" class="chanlogo">
          <div class="meta"> 
              <span class="title "> {{ $c->channel_name }} </span>
              <span class="pull-right"><a href="{{ url('channel/'.$c->channel_id) }}">
                <!-- <img src="{{ asset('assets/img/chanscope.png') }}"> -->
                <i class="fa fa-search" style="color:#fff"></i>
              </a></span>
          </div>
        </div>
      </div>
    @endforeach
  @endif
</div>
