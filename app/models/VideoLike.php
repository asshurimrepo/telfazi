<?php


class VideoLike extends Eloquent{
	protected $fillable = array('user_id', 'video_id', 'like', 'dislike');
	protected $table = 'video_likes';

	public function scopePopular($q)
	{
		return $q->with('video')->groupBy('video_id')->select('video_id', DB::raw('COUNT(video_id) as likes'))->whereLike(1)->orderBy('likes', 'desc');
	}

	public function video()
	{
		return $this->belongsTo('Video');
	}
}