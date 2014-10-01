<?php

class UserInformation extends Eloquent{
	protected $table = 'user_informations';

	public function getProfilePicture(){
		$thumb = array('thumb2.jpg', 'thumb3.jpg');

		/*if(!file_exists('assets/vidthumbs/'.$this->thumbnail) || !trim($this->thumbnail)){
			return $thumb[$thumb_type];
		}*/

		if(file_exists($this->profile_picture) || empty($this->profile_picture)){
			return asset('assets/img/profile_placeholder.jpg');
		}

		return $this->profile_picture;
	}
}
