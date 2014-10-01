<?php 
class ChannelSubscribe extends Eloquent{
	protected $table = "channel_subscribers";

	public function user(){
		return $this->hasOne('User', 'id', 'user_id');
	}

	public function userChannel(){
		return $this->hasOne('UserChannel', 'id', 'channel_id');
	}

	public static function getTotal( $user = '' ){
		if(! $user ){
			$user = Auth::user();
		}

		$subscribers = array();
    	$uc = $user->userChannels;
    	if(count($uc) > 0){
    		foreach($uc as $u){
    			$sub = ChannelSubscribe::where('channel_id', $u->id)->first();
    			if($sub){
					$subscribers[] = $sub;
    			}
    		}
    	}

		return count($subscribers);
	}
}
