@extends('layouts.alpha')

@section('content')

<div class="separator-space"></div>

@if($videos->count() > 0)
<div class="alert alert-danger" role="alert">
    <b>Search result found {{$videos->count()}} videos </b>
</div>
@endif

@include('components.videos.browse.collection', array('type'=> $type) )

@stop