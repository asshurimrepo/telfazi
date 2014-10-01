<?php
$ddclass = '';
if( isset( $dropdown_class ) && $dropdown_class )
	$ddclass = $dropdown_class;
?>


<div class="btn-group">
	<button type="button" class="btn btn-dark btn-sm dropdown-toggle" data-toggle="dropdown">
		{{ ucfirst($filter) }} <span class="caret"></span>
	</button>
	<ul class="dropdown-menu dd-dark {{ $ddclass }}" role="menu">

    @if( isset($type) && $type == 'videos' )
        {{--
        @if( isset($is_category) && $is_category == true )
                    <li><a href="{{ url( $url ) }}">All Videos</a></li>
                @else
                    <li><a href="{{ url($target) }}">All Videos</a></li>
                @endif
        --}}
        <li><a href="{{ url($target) }}">All Videos</a></li>


    @elseif( isset($type) && $type == 'channels' )
        <li><a href="{{ url('channels') }}">All Channels</a></li>
    @endif

	<li class="divider"></li>

		@include('layouts.home.categorydropdown', array('url'=> isset($url) ? $url : 'channels'  ))

	</ul>
</div>