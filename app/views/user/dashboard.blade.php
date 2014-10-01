@extends('layouts.alphaprofile')

@section('content')


<div class="widget-box">
    <div class="separator-space-sm">
        <a class="btn btn-primary btn-sm" href="{{ URL::to('upload/'.$channelID) }}">
            <b>Upload Video</b>
        </a>
    </div>

    {{--Post form--}}
        @include('components.feeds.feed_post_form')
    {{--Post form--}}

@if($feed_total > 0 )
        {{--Feeds--}}
        <div id="feedcon">
            @include('user.feed.feed')
        </div>
        {{--Feeds--}}

        <div class="separator-space"></div>
            @include('components.feeds.feed_load_btn')
        <div class="separator-space"></div>

    </div> {{--End of widget--}}
@else
    <div class="separator-space"></div>
    <div class="alert alert-danger" role="alert">Welcome! there are no new feeds found.</div>
@endif







<script type="text/javascript">
  $(function(){
    $('.feedmore').click(function(){
        var page = this.id;

        $.ajax({
          url: "{{ url('mytv') }}",
          type: "POST",
          data: { 
            feed_more: true, 
            user_id: "{{ Crypt::encrypt($user->id) }}", 
            page: page, 
            is_viewing: '{{ $isViewing }}', 
            take:  '{{ $take }}'
          },
          success: function( html ){
            var npage = parseInt(page) + 1;

            console.log(html);

            if(html){
              $('#feedcon').append(html);
              $('.feedmore').attr('id', npage);
            }else{
              $('#feedcon').append('<div class="alert alert-warning">'+
                '<b> <i class="glyphicon glyphicon-warning-sign"></i> No activity feeds available </b> '+
            '</div>');
              $('.loadbox').html('');
            }    
          }
        });
    });
  });
</script>

@stop

