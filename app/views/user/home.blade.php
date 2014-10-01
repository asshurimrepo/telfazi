@extends('layouts.alpha')


@section('content')
    <?php
        $data = array(
            'video' => $video,
            'videoList' => $videoList
        );
    ?>
    @if($video)
        @include('video.videoplayer', array('video', $data ))
    @else
        <div style="text-align:center"> 
            No Available Videos Yet. 

            <a href="{{ URL::to('upload/'.$user->channelID) }}">Upload</a>
        </div>
    @endif 
@stop

@section('scripts')
<script>
 $(function(){
    $('#sortingArea').load('{{ URL::to("categories") }}', function( response ){});
 });
</script>
@stop