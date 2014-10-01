<?php

$page_heading = '&nbsp;';
if( isset($heading) && $heading )
	$page_heading = $heading;

?>

<div class="profile-header">
  <form action="#">
    <input type="hidden" name="user_id" id="set_user_id" data-value="{{ $user->id }}" >
  </form>
  
  <div class="stats">
    <div class="stat-box notify-disabled">
      <i class="icon-wrench"></i>
      <span class="count badge badge-important" id="get_total_subscribes">0</span>
      <span class="stat-text">Subscribers</span>
    </div>
    <div class="stat-box notify-disabled">
      <i class="icon-group"></i>
      <span class="count badge" id="get_total_videos">0</span>
      <span class="stat-text">Videos</span>
    </div>
    <!-- <div class="stat-box notify-disabled">
    <i class="icon-group"></i>
    <span class="count badge">44</span>
    <span class="stat-text">Users</span>
    </div>
    <div class="stat-box notify-disabled">
     <i class="icon-shopping-cart"></i>
     <span class="count badge badge-success">56</span>
     <span class="stat-text">Orders </span>
    </div>
    <div class="stat-box notify-disabled">
     <i class="icon-calendar"></i>
     <span class="count badge badge-info">6</span>
     <span class="stat-text">Metting </span>
    </div>
    <div class="stat-box notify-disabled">
     <i class="icon-download-alt"></i>
     <span class="count badge badge-warning">15</span>
     <span class="stat-text">Requests </span>
    </div>   -->                                                                 

  </div>

  <h1 class="page-title">{{ $page_heading }}</h1>
</div>

<script type="text/javascript">

$(function(){
  
});

</script>