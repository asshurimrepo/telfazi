
<div class="row recommended">
  <div id="categories">
    @if(count($channels)>0)


      @foreach( $channels as $c )
 
        <div class="col-md-3 col-xs-12 col-sm-6 entity">
          <figure>
            <div class="vidThumb ">
                <div style="background: url({{ $c->getThumbnail() }}) no-repeat center; 
                background-size:cover;">
                    <a href="{{ URL::to('channel/'.$c->id) }}">
                        <img src="{{ asset('assets/img/channel_cover.png') }}">
                    </a>
                </div>
            </div>
            <!-- <a href="{{ URL::to('channel/'.$c->id) }}" title="{{ $c->channelName() }}">
              <img src="{{ asset('assets/img/thumb3.jpg') }}" width="100%">
            </a> -->
            <div class="meta text-left">
              <span class="head">
                <a href="{{ URL::to('channel/'.$c->id) }}" class="inline">&nbsp; {{ $c->channelName() }}</a> 
              </span>
              
              <div class="separator-space-xsm"></div>
              <div class="subscribe" id="{{ $c->channel_id }}">

                @include('channel.lists.subscribe')
                
              </div>
            </div>
          </figure>
        </div> 
      @endforeach

    @else
    <div style="margin: 70px 0 70px 0; "></div> 
      <div class="alert alert-danger" role="alert">
        <b>Sorry! No channels found. </b>
      </div>
     <div style="margin: 70px 0 70px 0; "></div>  
    @endif
  </div>
</div>




<script type="text/javascript">
$('.n_subscribe').click(function(e){
    e.preventDefault();
    var subscribeTo = this.id;

    $.ajax({
      url: "{{ URL::to('channel/subsTo') }}",
      type: 'post',
      data: { subscribeTo: subscribeTo}
    }).done(function( data ){
      
      console.log(data);


      var url = '{{ URL::to("channel/'+data.subscribeTo+'/subscribe") }}';

      $('.subscribe#'+data.subscribeTo).load(url);

    });
});
  
</script>