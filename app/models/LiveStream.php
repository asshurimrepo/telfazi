<?php

class LiveStream extends Eloquent{
	protected $table = "livestreams";

	public function getUrl(){
		return $this->url;
	}

	public function video(){
		return $this->hasOne('Video', 'id', 'video_id');
	}

	public function gotoUrl(){
		return url('live/'.$this->id);
	}

	public function getVideo(){
		return Video::withNotPublished()->where('videos.id', $this->video_id)->first();
	}

	public function getViews(){
		if($this->getVideo()){
			return $this->getVideo()->getViews();
		}else{
			return 0;
		}
	}

	public function getTitle( $limit = '30'){
		return str_limit($this->subname, $limit, '...');
	}

	public function getThumbnail(){
		return 'https://s3-us-west-2.amazonaws.com/vidorabia/livestreams/'.$this->thumbnail;
	}
}