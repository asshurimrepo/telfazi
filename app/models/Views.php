<?php

class Views extends Eloquent {
	protected $fillable = array('video_id','ip_address','info');
	protected $table = 'views';

	public function scopeMostViewed($q)
	{
		return $q->select('video_id', DB::raw('COUNT(video_id) as views') )->groupBy('video_id')->orderBy('views', 'desc');
	}

	public function video()
	{
		return $this->belongsTo('Video');
	}

}