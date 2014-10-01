@foreach($recentVideos as $v)

  <div class="row activity-feed">
  <div class="col-md-1">
    <a class="author-thumb" href="#"><img src="{{ asset('assets/img/thumb-placeholder.jpg') }}" width="39" height="39"></a>
  </div>
  <div class="col-md-11 ">
    <div class="note"><a href="{{ URL::to('mytv') }}">You </a> posted a new video</div> 
    <a href="{{ URL::to('watch/'. $v->id) }}" class="pull-left"><img src="{{ $v->getThumbnail(0) }}" width="140"></a>
    <div class="vidThumb">
      <span class="burb">{{ $v->title }}</span>
      <span class="date">{{ date('F d Y h:i a', strtotime($v->created_at) ) }}</span>
      <span class="views"><em>{{ $v->views()->count() }}</em> views</span>
      <span class="description"> {{ $v->getDescription() }}</span>
    </div> 
  </div>
</div> 
<div class="separator-line"></div>

@endforeach


<!-- 
<div class="row activity-feed">
  <div class="col-md-1">
    <a class="author-thumb" href="#"><img src="{{ asset('assets/img/thumb-placeholder.jpg') }}"></a>
  </div>
  <div class="col-md-11 ">
    <div class="note"><a href="">Beverly</a> posted a new video</div> 
    <a href="" class="pull-left"><img src="{{ asset('assets/img/thumb3.jpg')}}"></a>
    <div class="vidThumb">
      <span class="burb">Video Title Here</span>
      <span class="date">January 13, 2014</span>
      <span class="views"><em>5,600</em> views</span>
      <span class="description"> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</span>
    </div> 
  </div>
</div> -->