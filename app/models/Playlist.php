<?php


class Playlist extends Eloquent{
	protected $fillable = array('playlist_name', 'playlist_description');
	protected $table = 'playlists';


	public function videoplaylist(){
		return $this->hasMany('VideoPlaylist', 'playlist_id', 'id');
	}

	public function videos(){
		return $this->belongsToMany('Video', 'video_playlists');
	}

	public function getByUser( $user_id ){
		$playlistId = $this->getKey();

		$playlistData = VideoPlaylist::where( 'user_id', $user_id )->get();

		return $playlistData;
	}
}