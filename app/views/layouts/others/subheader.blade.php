<div class="header" style="background: url({{ asset('assets/img/header-strip.jpg') }}); ">
<?php

  $activeAt = array('','','','','', '');
  $stack = array('','videos/mostviewed', 'videos/popular', 'category', 'live', '/');
  $key = array_search( Request::path(), $stack);
  
  $activeAt[$key] = 'active';

?>
  <div class="container"> 
    <div class="row">
      <div class="col-md-12 " >
        <div class="logo-img pull-left"><a href="{{ URL::to('') }}">
          @if(Session::get('lang') == 'ar')
            <img src="{{ asset('assets/img/logo-ar.png') }}" width="180"></a>
          @else 
            <img src="{{ asset('assets/img/logoblue.png') }}" width="180"></a>
          @endif
          <span class="shout">Your home of latest videos</span>
        </div>

        <div class="pull-right">
          <div class="separator-space-sm"></div>
          <div class="row">
            <div class="col-md-5 col-md-offset-7 col-sm-12">
              <div>
          
              </div>
            </div>
          </div>

          <div class="row hidden-xs">
            <div class="separator-space-xsm"></div>

<ul class="list-unstyled list-inline header-menu">
<li><a href="{{ url('mustwatch') }}" class="feat btn btn-block {{ $activeAt[5] }}">{{ Lang::get('lang.featured') }}</a> </li>
<li class="dropdown" style="list-style:none;">

    <a href="#" class="dropdown-toggle btn btn-block feat" data-toggle="dropdown">{{ Lang::get('lang.categories') }} <b class="caret"></b></a>
    <ul class="dropdown-menu list-unstyled">
        @include('layouts.home.categorydropdown', ['slug' => 'category'])
    </ul>

</li>
  <li><a href="{{ url('live') }}" class="btn btn-block feat {{ $activeAt[4] }}">{{ Lang::get('lang.watch_live') }}</a></li>
</ul>


          </div>
        </div>

      </div>
    </div>
  </div>



  <div class="row visible-xs">
    <div class="separator-space-xsm"></div>
    <div class="header-menu">
      <a href="{{ url('mustwatch') }}" class="feat btn btn-block {{ $activeAt[0] }}">{{ Lang::get('lang.featured') }}</a>
      <li class="dropdown" >

        <a href="#" class="dropdown-toggle btn btn-block feat" data-toggle="dropdown">{{ Lang::get('lang.categories') }} <b class="caret"></b></a>
        <ul class="dropdown-menu list-unstyled list-inline text-center">
            <li>
                @include('layouts.home.categorydropdown')
            </li>
        </ul>

      </li>

      <a href="{{ url('live') }}" class="btn btn-block {{ $activeAt[4] }} feat">{{ Lang::get('lang.watch_live') }}</a>
    </div>
  </div>  
</div>