<?php

class Tag extends Eloquent {
	protected $table = 'tags';

	public function videos(){
		return $this->belongsToMany('Video', 'video_tag');
	}
}