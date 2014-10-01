<?php

class RecentVideo extends Eloquent{
	protected $table = 'recent_videos';


	public function video(){
		return $this->hasOne('Video', 'id', 'video_id');
	}

	public static function getRecentUploads( $user_id, $channel_id = '' ){
		$user = User::findOrFail($user_id);
		$videos = array();
		$uploads = RecentVideo::where('user_id', $user->id)->where(function($query) use ( $channel_id ){
			if($channel_id){
				$query->where('channel_id', $channel_id);
			}
		})->orderBy('created_at', 'desc')->get();

		if( count($uploads) > 0){
			foreach($uploads as $u){
				$v = new Video();
				$v->withNoStatus(true);
				$v = $v->where('id', $u->video_id)->first();

				$videos[] = $v;
			}
		}

		return $videos;
	}
}