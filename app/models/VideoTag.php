<?php

class VideoTag extends Eloquent{
	protected $table = "video_tag";

	public function video(){
		return $this->belongsTo('video');
	}
}