<?php 

class UserChannel extends Eloquent{
	protected $table = "user_channels";

	public static function validate($input, $rules = array()){
		if( empty($rules) ){
			$rules = array(
		        'channel_name' => 'Required',
		        'channel_description'     => 'Required',
			);
		}		 

		return Validator::make($input, $rules);
	}

	public function channel()
	{
		return $this->hasOne('Channel', 'channel_id','channel_id');
	}

	public function user(){
		return $this->hasOne('User', 'id', 'user_id');
	}

	public function channelcategory(){
		return $this->hasOne('ChannelCategory', 'channel_id','channel_id');
	}

	public function subscribeBy( $user_id ){
		return ChannelSubscribe::where('user_id', $user_id )->where('channel_id', $this->channel_id)->first();
	}

	public function subscribers(){
		return $this->hasMany('ChannelSubscribe', 'channel_id', 'id');
	}

	public function videos(){
		return $this->belongsToMany('Video', 'channels', 'channel_id');
	}

	public function recentVideos( $numVideos = 5 ){
		$videos = array();

		$channels = Channel::where('channel_id', $this->channel_id)
			->orderBy('created_at', 'desc')
			->take($numVideos)
			->get();
			
		foreach( $channels as $c ){
			if($c->video){
				$videos[] = $c->video;
			}
		}

		return $videos;
	}

	public function channelName(){

		if(empty($this->channel_name)){

			return $this->user->getDisplayName(); 
		}

		return $this->channel_name;
	}


	public function getThumbnail(){

		$thumb = 'channelthumb.jpg';

		if(file_exists($this->thumbnail) || empty($this->thumbnail)){
			return asset('assets/img/thumb3.jpg');
		}

		return $this->thumbnail;
	}

	
}