<?php
class ActivityFeed extends Eloquent{
	protected $table = 'activity_feeds';

	public function type()
	{
		return $this->hasOne('ActivityType', 'id', 'type_id');
	}

	public function user(){
		return $this->hasOne('User', 'id', 'user_id');
	}

	public function uname(){
		return ucwords($this->user->first_name . ' ' . $this->user->last_name);
	}

	// fetch all feeds to specified user id.
	public static function allFeeds($user_id){		

		$feeds = ActivityFeed::where('user_id', $user_id)->orWhere(function( $q ) use( $user_id ){

			$subids = array();
			
			// get feeds from channel subscribed
			$subs = ChannelSubscribe::where('user_id', $user_id)->get();

			foreach($subs as $s){
				if($s->userChannel){
					$subids[] = $s->userChannel->user_id; // get the user id of the channel subscribed.	
				}
			}

			//loop through each id and query.
			foreach($subids as $i){
				$q->orWhere('user_id', $i);
			}
		});

		return $feeds;
	}
}

