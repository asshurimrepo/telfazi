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
.browselist li .active { font-weight: bold;  }
</style>
@stop

@section('content')

<style type="text/css">

</style>

<?php

$activeAt = array('','','');
$stack = array('browse', 'browse/popular', 'browse/newest');
$key = array_search( Request::path(), $stack);

$activeAt[$key] = 'active';

?>


@include('video.browse_feature')


<div class="separator-space"></div>

@include('layouts.home.videos')


@stop

