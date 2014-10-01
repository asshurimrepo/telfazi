<?php
$activeAt = array('','','');
$stack = array('category', 'popular', 'newest');

$key = array_search( $slug, $stack);
$activeAt[$key] = 'active'; ?>

<div class="separator-space"></div>

<div class="row">
    <div class="col-md-12">
        <div class="pull-left">
            <ul class="list-unstyled list-inline browselist" style="margin-top:5px;">
                @if( $is_category )
                    <?php $this_url = route('browse_videos_page', ['category', $category_id]); ?>
                @else
                    <?php $this_url = route('browse_videos_page'); ?>
                @endif
                <li><a href="{{ $this_url }}" class="{{ $activeAt[0] }}">
                    {{ Lang::get('lang.all_videos') }}
                </a></li>
                <li>|</li>
                <li><a href="{{ route('browse_videos_page', ['popular', $category_id] ) }}" class="{{ $activeAt[1] }}">
                    {{ Lang::get('lang.most_popular') }}
                </a></li>
                <li>|</li>
                <li><a href="{{ route('browse_videos_page', ['newest', $category_id] ) }}" class="{{ $activeAt[2] }}">
                    {{ Lang::get('lang.newest') }}
                </a></li>
            </ul>
        </div>

        <div class="pull-right">
            <span class="feeder-header" style="text-transform: capitalize;"><b>Category</b></span>

            @include('layouts.home.categorydd', [
                'dropdown_class'=> 'pull-right',
                'type'=> 'videos',
                'url' => 'browsevids',
                'target' => $url_segments
            ])

        </div>
    </div>
</div>

<div class="separator-space-sm"></div>

{{-- jscroll div --}}
<div class="browse-scroll">

    @include('components.videos.browse.collection')

</div>
<script>
$(function(){
    $('.browse-scroll').jscroll();
});
</script>
