<?php

class WatchedVideo extends Eloquent{

	protected $table = 'watched_videos';

	public function video()
	{
		return $this->belongsTo('Video');
	}

	public function user()
	{
		return $this->belongsTo('User');
	}
}