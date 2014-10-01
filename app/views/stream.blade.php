@extends('layouts.alpha')


@section('head')
<style type="text/css">
.squad .container{ background: none !important; }
.header-menu .feat:hover { color:#fff !important; background: none; }
.header-menu .feat:hover, .header-menu .active {
  color:#fff !important; 
  -webkit-box-shadow: none;
  -moz-box-shadow:    none;
  box-shadow:         none;
  background: none;
}
.container { margin: 0 auto; max-width: 1070px; }
.container-fluid { background: none !important; }
</style>
@stop

@section('content')


<script>
	$(function(){
	    $('#grid').grid();

	});
</script>

<div id="grid" data-directory="streams"></div>

@stop
