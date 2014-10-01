@extends('layouts.alpha')

@section('head')
    <style type="text/css">
    .squad .container{ background: none !important; }
    .container-fluid { background: none !important; }
    </style>
@stop

@section('content')

@include('layouts.home.socialbtns')
    <div class="nopadd">
      <h2 class="featTitle"><a href="{{ url('/') }}">
        Featured Videos</a>
      </h2>
    </div>
    <div class="separator-space" style="margin-bottom: 80px;">
        <div class="parial-loader" data-url="{{ route('video_feature_partial') }}" data-partial="data-partial"></div>
    </div>

    
    <div class="separator-space">
        <div class="parial-loader" data-url="{{ route('video_livestream_partial') }}" data-partial="data-partial"></div>
    </div>

    @foreach(Category::getAll( Session::get('lang_id') ) as $category)
    <div class="separator-space">
        <div class="parial-loader" data-url="{{ route('video_category_partial', [ 'cat_id' => $category->id ]) }}" data-partial="data-partial"></div>
    </div>
    @endforeach
@stop

@section('scripts')

@stop

