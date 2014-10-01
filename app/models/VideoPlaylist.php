<?php

class VideoPlaylist extends Eloquent{
	protected $fillable = array('video_id', 'channel_id', 'playlist_id');
	protected $table = 'video_playlists';

	public function user(){
		return $this->hasOne('User', 'id', 'user_id');
	}	

	public function video(){
		return $this->hasOne('Video', 'id', 'video_id');
	}

	public function playlist(){
		return $this->hasOne('Playlist', 'id', 'playlist_id');
	}
	
}