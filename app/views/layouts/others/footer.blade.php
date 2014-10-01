<?php 
$enable = true;
if( isset( $enable_footer ) && $enable_footer == false )
  $enable = false;
?>

@if( $enable )
<div class="clearfix"></div>
<div id="footer">
    <div class="container">
      <div class="row">
        
        <div class="col-md-3">
          <div class="logo">
            <div class="text-center">
              @if(Session::get('lang') == 'ar')
                <img src="{{ asset('assets/img/logo-ar.png') }}" width="130" class="img-responsive center-block">
              @else 
                <img src="{{ asset('assets/img/logoblue.png') }}" width="130" class="img-responsive center-block">
              @endif
              
              &copy; 2014 Telfazi. {{ Lang::get('lang.all_rights_reserved') }}.
            </div>
          </div>
        </div>

        <div class="col-md-1 hidden-xs hidden-sm">
          <div class="center-block">
            <div class="part-slicer">&nbsp;</div>
          </div>
        </div>
        
        <div class="col-md-2 col-xs-6 col-sm-3 foot">
          <h4>Telfazi</h4>
          <ul>
            <li>{{ Lang::get('lang.about') }}</li>
            <li><a href="{{ URL::to('channels') }}">{{ Lang::get('lang.channels') }}</a></li>
            <li><a href="{{ route('browse_videos_page') }}">{{ Lang::get('lang.all_videos') }}</a></li>
            <li>{{ Lang::get('lang.blog') }}</li>
          </ul>
        </div>

        <div class="col-md-2 col-xs-6 col-sm-3 foot">
          <h4>{{ Lang::get('lang.help') }}</h4>
          <ul>
            <li>{{ Lang::get('lang.faq') }}</li>
            <li>{{ Lang::get('lang.contact_us') }}</li>
          </ul>
        </div>
        
        <div class="col-md-2 col-xs-6 col-sm-3 foot">
          <h4>{{ Lang::get('lang.legal_terms') }}</h4>
          <ul>
            <li>{{ Lang::get('lang.terms_of_use') }}</li>
            <li>{{ Lang::get('lang.privacy_policy') }}</li>
            <li>{{ Lang::get('lang.prohibited_content') }}</li>
          </ul>
        </div>

        <div class="col-md-2 col-xs-6 col-sm-3 foot">
          <h4>{{ Lang::get('lang.get_socials') }}</h4>
          <ul>
            <li><a href="{{ $twitter_url }}"><i class="fa fa-twitter-square"></i>&nbsp; Twitter</a></li>
            <li><a href="{{ $facebook_url }}"><i class="fa fa-facebook-square"></i>&nbsp; Facebook</a></li>   
            <!-- <li><i class="fa fa-linkedin-square"></i>&nbsp; LinkedIn</li>
            <li><i class="fa fa-instagram"></i>&nbsp; Instagram</li>
            <li><i class="fa fa-google-plus-square"></i>&nbsp; Google+</li> -->
          </ul>
        </div>


      </div>
    </div>
  </div>
  <div class="clearfix"></div>
</div>

@endif

    <!-- main javascripts -->
    @include('scripts.main')

    <script src="{{ asset('iboostme/js/loaders/partialLoader.js') }}" type='text/javascript'></script>
    <script src="{{ asset('iboostme/js/scrolls/jscroll/jquery.jscroll.min.js') }}" type='text/javascript'></script>
    @yield('scripts')

      
  <script type='text/javascript'>

    $(document).ready(function() {

        // Make a scrollable pane
        $('.scrollbox').jScrollPane();


        
        //Selectize
        $('#searchbox').selectize({
            valueField: 'url',
            labelField: 'title',
            searchField: 'title',
            maxOptions: 10,
            options: [],
            create: false,
            render: {
                option: function(item, escape) {
                  console.log(item);
                    return '<div><img src="'+ item.icon +'" width="20">&nbsp' +escape(item.name)+'</div>';
                }
            },
            /*optgroups: [
                {value: 'product', label: 'Products'},
                {value: 'category', label: 'Categories'}
            ],
            optgroupField: 'class',
            optgroupOrder: ['product','category'],*/
            load: function(query, callback) {
                if (!query.length) return callback();

                $.ajax({
                    url: "{{ URL::to('query') }}", // url to search
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        q: query
                    },
                    error: function() {
                        callback();
                    },
                    success: function(res) {
                        callback(res.data);
                    }
                });
            },
            onChange: function(){
                window.location = this.items[0];
            }
        });

        @yield('jwplayer')




      });
  </script>

    </body>
</html>

<style type="text/css">
.scrollbox{
  height: 360px;
  background-color: #292929;
  overflow: scroll;
}

.foot { height: 180px;}

.jspTrack
{
    background: #292929; /* changed from #dde */
    position: relative;
}
 
.jspDrag
{
    background: #464646;
   /* background: rgba(0,0,0,0.2); *//* changed from #bbd */
    position: relative;
    top: 0;
    left: 0;
    cursor: pointer;
}

</style>