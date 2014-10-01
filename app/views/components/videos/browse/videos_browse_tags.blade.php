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

<div style="max-width: 1260px; margin: 0 auto;">
        {{-- jscroll div --}}
        <div class="browse-scrolsl">

            @include('components.videos.browse.collection')

        </div>
        <script>
            $(function(){
                $('.browse-scroll').jscroll();
            });
        </script>
</div>
@stop




