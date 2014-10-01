<?php

class VideoCategory extends Eloquent{
	// Name of the database table
	protected $table = 'video_category';

	public function category(){
		return $this->hasOne('Category', 'id', 'category_id');
	}

}