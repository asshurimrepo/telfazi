

@extends('layouts.alpha')

@include('scripts.fblogin')

@section('meta')
    <meta property="og:title" content="{{ $video->getTitle() }}" />
    <meta property="og:description" content="{{ $video->getDescription() }}" />
    <meta property="og:image" content="{{ $video->getThumbnail() }}" />
    <meta property="og:video" content={{ $video->gotoUrl() }} />
    <meta property="og:video:width" content="560" />
    <meta property="og:video:height" content="340" />
    <meta property="og:video:type" content="application/x-shockwave-flash" />
@stop

<?php
    $singleTag = '';
    if( count($video->tags) > 0){
        $singleTag = $video->tags()->first()->name;
    } ?>

@section('content')
<div style="max-width: 1260px; margin: 0 auto;">

    @include('layouts.home.socialbtns')

    <div class="row">
        <div class="col-md-12">

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="alpha-header">
                <h3><b>{{ $video->getTitle() }}</b></h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            @include('components.socials.socials_vertical')

            @include('video.videoplayer', array('video' => $video))

            <div class="clearfix separator-space-sm"></div>

            @include('layouts.frag.feeder_descriptionbox', array('video' => $video))
            {{-- Go to www.addthis.com/dashboard to customize your tools --}}
            <div class="addthis_sharing_toolbox" data-image={{ $video->getThumbnail() }}></div>
            <div class="separator-space-sm"></div>

            <!-- Video Comment Box -->
            @include('layouts.frag.feeder_commentbox')


            {{-- Video Tags--}}
            <div class="row">
                <div class="col-md-12">
                    <div class="whitelabel">Other videos you may like</div>
                    <form action="#">
                        <input type="hidden" id="set_video_id" data-value="{{ $video->id }}">
                    </form>
                    <div class="video-tags">
                        {{-- html here --}}

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">

            @include('components.mpu')


            <div class="separator-space-sm"></div>

            <div class="">
                <div class="bg-info info-head" style="">
                    <i class="fa fa-youtube-play"></i> Related
                </div>
                <div class="separator-space-sm"></div>

                <div id="relatedcon">
                    <div class="text-center">
                        <span class="livicon " data-name="spinner-four" data-l="true" style="color:#fff"></span>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="separator-space"></div>
</div>




@include('layouts.others.loginmodal')

<script type="text/javascript">
    $(function(){
        $.ajax({
            url : '{{ url("relatedvids/".$video->id) }}',
            success : function( html ){

                $('#relatedcon').html(html);
            }
        });
    });
</script>

@stop


