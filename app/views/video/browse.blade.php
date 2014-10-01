@extends('layouts.alpha')

@section('head')
<style type="text/css">
body, a { color: #fff !important; }
.feeder-header b { color: #fff; }
.squad .container{ background: none !important; }
.squad .container{ background: none !important; }
.container-fluid { background: none !important; }

.browselist {  font-size: 16px; }
.browselist li a { color: #333; }
.browselist li a:hover { text-decoration: none; }
.browselist li .active { font-weight: bold; background: #012237; padding: 8px 20px; }
</style>
@stop


@section('content')

@if($video)
<div style="max-width: 1260px; margin: 0 auto;">

    <?php
    $activeAt = array('','','');
    $stack = array('browse', 'browse/popular', 'browse/newest');
    $key = array_search( Request::path(), $stack);
    $activeAt[$key] = 'active';?>

    @include('components.socials.socials_vertical')



    @if( isset($enable_featuring) && $enable_featuring == false )
            <div class="row">
                <div class="col-md-12">

                    <span class="feeder-header" style="text-transform: capitalize;"><b>
                        {{ $heading }}
                    </b></span>
                </div>
            </div>
        @else
            @include('video.browse_feature')

            <div class="separator-space"></div>

        @endif

        <div class="separator-space-sm"></div>

        {{-- Get the video browse partial page --}}
        <div class="parial-loader" data-url="{{ route('browse_videos', [ $slug , $category_id ]) }}" data-partial="data-partial"></div>
</div>
@else
    <div style="min-height: 200px">
        @include('components.alerts.alert_message', ['type'=>'error', 'message' => 'Sorry, no videos found.'])
    </div>
@endif
@stop

