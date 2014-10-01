<?php

class Channel extends Eloquent{
	public function userchannel(){
		return $this->hasOne('UserChannel','id','channel_id');
	}

	public function video(){
		return $this->hasOne('Video', 'id', 'video_id');
	}
}
