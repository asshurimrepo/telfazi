@if( count($videos) > 0)
    <div id="browse_vids">
        <div class="row vidlist">

    @foreach( $videos as $i => $v )

        @include('layouts.home.carousel.vidsmall', array('v' => $v))

    @endforeach
        </div>
    </div>

    @if( isset( $url_to_scroll) )
        <a href="{{ url( $url_to_scroll ) }}"></a>
    @endif
@else
    <div class="alert alert-danger" role="alert" id="error-message">
        <b>Sorry! No videos found. </b>
    </div>
@endif