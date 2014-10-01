<div class="row activity-feed">
  @if(Session::get('lang') == 'ar')
    <div class="col-md-11 ">
      <form action="{{ URL::to('mytv') }}" method="post">
        <textarea class="form-control" rows="3" name="post" placeholder="Share your thoughts"></textarea><br>

        <button type="submit" name="submit" class="btn btn-primary btn-sm postbtn" >Post</button>
      </form>
    </div>
    <div class="col-md-1">
      <div class="vidThumb ">
        <div class="uicon" style="background: url({{ $user->getThumbnail() }}) no-repeat center;
        background-size:cover; width:39px; height:39px;">
            <a href="#">
                <img src="{{ asset('assets/img/profile_cover.png') }}">
            </a>
        </div>
    </div>
    </div>

  @else
    <div class="col-md-1">
      <div class="vidThumb ">
        <div class="uicon" style="background: url({{ $user->getThumbnail() }}) no-repeat center;
        background-size:cover; width:39px; height:39px;">
            <a href="#">
                <img src="{{ asset('assets/img/profile_cover.png') }}">
            </a>
        </div>
    </div>
    </div>
    <div class="col-md-11 ">
      <form action="{{ URL::to('mytv') }}" method="post">
        <textarea class="form-control" rows="3" name="post" placeholder="Share your thoughts"></textarea><br>

        <button type="submit" name="submit" class="btn btn-primary btn-sm pull-right" >Post</button>
      </form>
    </div>
  @endif

</div>