<?php
//initial values
if(!isset($slug))
	$slug = 'category';
if(!isset($url))
	$url = 'browsevids';

?>

@foreach( $categories = Category::getAll(Session::get('lang_id')) as $i => $c )
	  <?php
	    $half = ceil(count($categories) / 2);
	    $icon = array_key_exists ( $i , $catIcons ) ? $catIcons[$i] : '';
	  ?>
		@if(Session::get('lang') == 'ar')

			<li class="pull-right">
				<a href="{{ url('browsevids', array($slug, $c->id)) }}">
			      <span>({{ $c->videos->count() }})</span>
			      {{ $c->title }}
			      <i class="{{ $icon }}"></i></a>
		    </li>

		@else

			<li>
				<a href="{{ url( $url , array($slug, $c->id)) }}">
			      <i class="{{ $icon }}"></i>
			      {{ $c->title }}
			      <span>({{ $c->videos->count() }})</span></a>
		    </li>

		@endif

@endforeach
