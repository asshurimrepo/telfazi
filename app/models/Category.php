<?php
//
class Category extends Eloquent {
	protected $table = 'categories';

	public function videos()
	{
		return $this->belongsToMany('Video','video_category');
	}

	public function channels()
	{
		$channels = array(); 
		$chanCat = ChannelCategory::where('category_id', $this->id)->get();
		foreach($chanCat as $c){
			$channels[] = UserChannel::where('channel_id', $c->channel_id)->first();
		}

		return $channels;
	}


	public static function getAll( $language = 2 ){
		return Category::where('language', $language)->get();
	}
}
