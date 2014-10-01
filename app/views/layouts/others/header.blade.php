<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="shortcut icon" href="{{ asset('assets/img/logoblue.ico') }}" type="image/x-icon"/>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        @yield('meta')

        <title>
          <?php 
          
          if(Auth::check()):
            $user = Auth::user()->mapData();
          endif;
          
          
          if(!empty($pageTitle)) {
            echo $pageTitle . ' | '.$siteTitle;
          }else{
            echo $siteTitle;
          } 

         ?></title>
        
        
        <!-- Jquery -->
        <script src="{{ asset('assets/jquery/js/jquery-1.10.2.js') }}"></script>
        <script src="{{ asset('assets/jquery/js/jquery-ui-1.10.4.min.js') }}"></script>
        
        <!-- Bootstrap -->
        @if( Session::get('lang') == 'ar')
          <!-- Arabic Bootstrap -->
          <script type='text/javascript' src="{{ asset('assets/bootstrap-ar/js/bootstrap.min.js') }}"></script>
          <link href="{{ asset('assets/bootstrap-ar/css/bootstrap.min.css') }}" rel="stylesheet">
        @else 
          <script type='text/javascript' src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}">
          </script>
          <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        @endif
        

        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/helper.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/extra.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/glyphicons.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/theme/dark.css') }}">

        @if(Session::get('lang') == 'ar')
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/arabic.css') }}">
        @endif

        <!-- ScrollPane -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/jscrollpane/jquery.jscrollpane.css') }}">

        <!-- Selectize -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/selectize/css/selectize.bootstrap3.css') }}">

        <!-- xEditable -->
        <link href="{{ asset('assets/js/xeditable/bootstrap3-editable/css/bootstrap-editable.css') }}" rel="stylesheet"/>

        <!-- Add FontAwsome here -->
        <link href="{{ asset('assets/js/fontawsome/css/font-awesome.min.css') }}" rel="stylesheet">

        <!-- Add Fontello here -->
        <link rel="stylesheet" href="{{ asset('assets/js/fontello/css/fontello.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/js/fontello/css/animation.css') }}">
        


        
        
        <!-- Uploadify -->
        <link rel="stylesheet" href="{{ URL::to('/assets/js/uploadify/uploadify.css') }}" />
        <script type='text/javascript' src="{{ URL::to('/assets/js/uploadify/swfobject.js') }}"></script>
        <script type='text/javascript' src="{{ URL::to('/assets/js/uploadify/jquery.uploadify.v2.1.4.min.js') }}"></script>

        <!-- Owl Carousel -->
        <link rel="stylesheet" href="{{ asset('assets/js/owl-carousel/owl.transitions.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/js/owl-carousel/owl.theme.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/js/owl-carousel/owl.carousel.css') }}" />
        <script type="text/javascript" src="{{ asset('assets/js/owl-carousel/owl.carousel.min.js') }}"></script>


        <!-- AutoTag -->
        <link href="{{ asset('assets/js/jquery_autotag/jquery.tagit.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/js/jquery_autotag/tagit.ui-zendesk.css') }}" rel="stylesheet" type="text/css">
        <script src="{{ asset('assets/js/jquery_autotag/tag-it.js') }}" type="text/javascript" charset="utf-8"></script>
        

        

        <!-- jsScrollPane -->
        <script src="{{ asset('assets/js/jscrollpane/mwheelIntent.js') }}"></script>
        <script src="{{ asset('assets/js/jscrollpane/jquery.mousewheel.js') }}"></script>
        <script src="{{ asset('assets/js/jscrollpane/jquery.jscrollpane.min.js') }}"></script> 

        <!-- xEditable -->
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53fbeb080990f972"></script>

        <!-- Share This! -->
        <script type="text/javascript">var switchTo5x=true;</script>
        <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
        <script type="text/javascript">stLight.options({publisher: "33a751db-fa5f-4bf6-a141-a11521c97a96", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>

        <!-- Add This  addthis.com -->
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53fbeb080990f972"></script>

        <!-- bxSlider --> 
         <script src="{{ asset('assets/js/bxslider/jquery.bxslider.min.js') }}"></script> 

        <!-- Selectize -->
        <script type="text/javascript" src="{{ asset('assets/js/selectize/js/standalone/selectize.min.js') }}"></script>

        <!-- Live Icons -->
        <script src="{{ asset('assets/js/liveicons/json2.min.js') }}"></script>
        <script src="{{ asset('assets/js/liveicons/raphael-min.js') }}"></script>
        <script src="{{ asset('assets/js/liveicons/livicons-1.3.min.js') }}"></script>


        <!-- "Polyglot" Language Switcher jQuery Plugin -->
        <link href="{{ asset('assets/js/polyglot/css/polyglot-language-switcher.css') }}" type="text/css" rel="stylesheet">
        <script src="{{ asset('assets/js/polyglot/js/jquery.polyglot.language.switcher.js') }}">
        </script>

        <!-- Auto Grid Responsive Gallery -->
        <link rel="stylesheet" href="{{ asset('assets/js/autogrid/css/gridGallery.css') }}" />

        <script src="{{ asset('assets/js/autogrid/js/rotate-patch.js') }}"></script>
        <script src="{{ asset('assets/js/autogrid/js/waypoints.min.js') }}"></script> 
        <script src="{{ asset('assets/js/autogrid/js/autoGrid.js') }}"></script>
        <!-- Auto Grid Responsive Gallery -->

        <!-- Google Tracking -->
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-54226251-1', 'auto');
          ga('send', 'pageview');

        </script>


        <!-- JWPLAYER -->
        <!--
        <script src="{{ asset('assets/js/jwplayer/jwplayer.js') }}"></script>
        <script src="http://jwpsrv.com/library/V+IAwuIEEeOpKiIACmOLpg.js"></script>
        -->

        <!-- Jwplayer Library -->
        <script src="http://jwpsrv.com/library/V+IAwuIEEeOpKiIACmOLpg.js"></script>
   

        <script type="text/javascript" src="http://tags.expo9.exponential.com/tags/3a6aayercom/ROS/tags.js"></script>

        @yield('head')

        <script src="{{ asset('assets/js/main.js') }}"></script>

    </head>
    
    <!-- HTML code from Bootply.com editor -->
    
    <body>



  <?php
    $nav_class = 'navbar-static-top';
    if( isset($fixed_top) && $fixed_top)
      $nav_class = 'navbar-fixed-top';
  ?>
  <nav class="navbar navbar-inverse {{ $nav_class }}" role="navigation"> 
  <div class="container">
      <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="menu nav navbar-nav">

            <?php $active = $toBeActive = ''; ?>
            @foreach($menuList as $title => $url)

                @foreach( $menuSegments as $tit => $segments )
                  <?php $segment = Request::segment(1); ?>


                  @if(in_array($segment, $segments))
                    
                   <?php $toBeActive = $tit; ?>

                  @endif
                  
                @endforeach
                
              <?php $active = '';  ?>
              @if( $toBeActive == $title )
                <?php $active = 'active' ?>
               
              @endif
             
              <li><a href="{{ $url }}" class="{{ $active }}">  {{ $title }}   </a></li>
              <li class="divider-vertical"></li>
            @endforeach
          </ul>


          <?php
            $activeAt = array('','');
            if( Request::segment(1) == 'login' ){
              $activeAt[0] = 'active';
            }

            if( Request::segment(1) == 'register' ){
              $activeAt[1] = 'active';
            }
          ?>


          <ul class="visible-xs visible-xs nav navbar-nav menu">
            @if( Auth::check() )
              <li><a class="dname" href="{{ URL::to('mytv/profile'); }}" class="card">
                {{ $user->getDisplayName() }}</a>
              </li>
              <li><a href="{{ URL::to('logout') }}"> Sign out</a></li>
            @else
              <li><a href="{{ URL::to('login') }}"> {{ Lang::get('lang.sign_in') }} </a></li>
              <li><a href="{{ URL::to('register') }}" > {{ Lang::get('lang.register') }}  </a></li>
              <form action="{{ URL::to('search') }}" method="get" class="search searchblue" id="search" style="padding:10px;">
                <div class="form-group right-inner-addon">
                  <i class="glyphicon glyphicon-search"></i>
                  <input type="text" class="form-control" name="q" placeholder="{{ Lang::get('lang.search') }}" >
                </div>
              </form>
            @endif
          </ul>

          <ul class="login nav navbar-nav navbar-right hidden-xs ">
          <li> 
            <form action="{{ URL::to('search') }}" method="get" class="search searchblue" id="search">
            <div class="form-group right-inner-addon">
              <i class="glyphicon glyphicon-search"></i>
              <input type="text" class="form-control" name="q" placeholder="{{ Lang::get('lang.search') }}" >
            </div>
          </form>
          </li> 
          <li>
            <div style="padding: 10px 10px 0 0;">
              
              @include('components.language')
            
            </div>
          </li>
              @if( Auth::check() )

          
          <li>
            <a href="{{ URL::to('mytv/profile') }}" style="width:30px; height:30px; margin: -5px 5px 0 10px;">
              <div style="background: url({{ $user->getThumbnail() }}) no-repeat center; 
                background-size:cover; width:30px; height:30px;"> 
              </div>
            </a>
          </li>
          <li>
            <a class="dname" href="{{ URL::to('mytv/profile') }}"> {{ $user->display_name ? $user->display_name : $user->username }} </a>
          </li>
          <li>
            <div id="outArea">
              <div class="btn-group" id="logbtn">
                
                  <span><i class="fa fa-cog"></i></span>
                  <a class="dropdown-toggle btn-lg ddbtn" data-toggle="dropdown" >
                    <span><i class="fa fa-sort-desc"></i></span>
                  </a>
                <ul class="dropdown-menu pull-right" role="menu">
        <li><a href="{{ URL::to('mytv') }}"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
        <li><a href="{{ URL::to('mytv/videos') }}"><i class="glyphicon glyphicon-tasks"></i> Video Manager</a></li>
        <li><a href="{{ URL::to('mytv/channels') }}"><i class="glyphicon glyphicon-sound-stereo"></i> My Channels</a></li>
        <li><a href="{{ URL::to('mytv/subscriptions') }}"><i class="glyphicon glyphicon-expand"></i> My Subscriptions</a></li>
        
        <li><a href="{{ URL::to('mytv/liked') }}"><i class="glyphicon glyphicon-thumbs-up"></i> My Liked Videos</a></li>
        <li><a href="{{ URL::to('mytv/play/1') }}"><i class="glyphicon glyphicon-list"></i> My Playlist</a></li>
        <li><a href="{{ URL::to('mytv/play/3') }}"><i class="glyphicon glyphicon-list"></i> My Favorites</a></li>
        <li><a href="{{ URL::to('mytv/play/2') }}"><i class="glyphicon glyphicon-time"></i> Watch Later</a></li>
        <li role="presentation" class="divider"></li>
        <li><a href="{{ url('settings')  }}"><i class="glyphicon glyphicon-cog"></i> Setting</a></li>
        <li><a href="{{ url('logout') }}"><i class="glyphicon glyphicon-log-out"></i> 
          {{ Lang::get('lang.sign_out') }}
        </a></li>
               
                </ul>  
              </div>
            </div>  
          </li>
              @else
                
                <li><a href="{{ URL::to('login') }}" class="{{ $activeAt[0] }}"> 
                  {{ Lang::get('lang.sign_in') }}
                </a></li>
                <li><a href="{{ URL::to('logout') }}"> | </a></li>
                <li><a href="{{ URL::to('register') }}" class="{{ $activeAt[1] }}"> 
                  {{ Lang::get('lang.register') }}
                </a></li>
              @endif
          </ul>
      </div>
      <!-- /.navbar-collapse -->      
  </div>
  <!-- /.container -->
</nav>










