
<?php
if($user->information){
	$profilepicture = $user->information->getProfilePicture();
}else{
	$profilepicture = asset('assets/img/profile_placeholder.jpg');
}
?>
<!-- Sidebar Menu -->
<div class="vidThumb" style="padding:10px; ">
  <div style="background: url({{ $user->getThumbnail() }}) no-repeat center; 
    background-size:cover;">
    <a href="#">
      <img src="{{ asset('assets/img/profile_cover.png') }}" width="162" >
    </a>
  </div>
</div>
<div style="border-bottom: 1px solid #111;"></div>
<ul class="nav nav-sidebar">
<?php 
$menu = array(
  'Dashboard' => url('mytv') ,
  'Video Manager' => url('mytv/videos'), 
  'My Channels' => url('mytv/channels'),
  'My Subscriptions' => url('mytv/subscriptions'),
  'My Liked Videos' => url('mytv/liked'),
  'My Playlist' => url('mytv/play/1'),
  'My Favorites' => url('mytv/play/3'),
  'Watch Later' => url('mytv/play/2'),
  );
$icons = array(
  'Dashboard' => 'glyphicon glyphicon-home',
  'Video Manager' => 'glyphicon glyphicon-tasks', 
  'My Channels' => 'glyphicon glyphicon-sound-stereo',
  'My Subscriptions' => 'glyphicon glyphicon-expand',
  'My Liked Videos' => 'glyphicon glyphicon-thumbs-up',
  'My Playlist' => 'glyphicon glyphicon-list',
  'My Favorites' => 'glyphicon glyphicon-list',
  'Watch Later' => 'glyphicon glyphicon-time',
  );

?>

@if(isset($isViewing) && $isViewing == false)
  @foreach($menu as $title => $url )
  <li class="active">
    <a href="{{ $url }}">
      <i class="{{ $icons[$title] }}"></i>&nbsp; {{ $title }} 
    </a>
  </li>
  @endforeach

@else
  <li class="active"><a href="{{ URL::to('user/' . $user->username ) }}"><i class="glyphicon glyphicon-home"></i> &nbsp; Dashboard</a></li>
  <li><a href="{{ URL::to('channels/' . $user->username) }}"><i class="glyphicon glyphicon-sound-stereo"></i> &nbsp; Channels</a></li>
  <li><a href="{{ URL::to('liked/' . $user->username ) }}"><i class="glyphicon glyphicon-thumbs-up"></i> &nbsp; Liked Videos</a></li>
@endif  
</ul>


<!-- Sidebar Menu -->
