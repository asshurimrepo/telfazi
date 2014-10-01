@extends('layouts.alpha')

@section('content')

<div class="row">
	<div class="col-md-12"> 
		<div class="pull-left">
		<span class="feeder-header "><b>{{ Lang::get('lang.filter_by') }}</b> </span> 	
			
			@include('layouts.home.categorydd', [
			'type'=>'channels'])
		
		</div>

		<div class="pull-right vertical-top" style="margin-top: 5px">
			<span class="feeder-header"><b>{{ ucfirst($filter) }}</b></span>
		</div>
	</div>
</div>
<div class="separator-space-sm"></div>


<div class="row vidlist">
              
  @if(count($channels) > 0 )
    @foreach( $channels as $c )
      
      @include('layouts.home.carousel.chansmall', array('c' => $c, 'enable_subscription' => true)) 
    @endforeach
  @endif
  
</div>


{{-- @include('channel.lists.channels') --}}

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
@stop