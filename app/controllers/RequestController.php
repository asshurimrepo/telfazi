<?php
class RequestController extends BaseController{
	// List of actions that are not allowed for the guess.
    protected $whitelist = array(
        'requestCategories', 'test', 'paginateVideos', 'addToPlaylist', 'videoLikes', 'requestRelatedVids', 'getAllVideos', 'getVideoTags'
    );

	public function requestTags(){
		$tagData = array();

		$query = Input::get('query');

		$tags = Tag::where('name', 'like' , '%'.$query.'%')->take(5)->get();

		foreach($tags as $t){
			$tagData[] = $t->name;
		}


		$data['tags'] = $tagData;

		return json_encode($data);
	}


	public function test(){
		
		return Video::find(2)->getThumbnail();
	}

	public function requestRelatedVids( $video_id ){
		$video = Video::where('id', $video_id)->first();

		$this->data['title'] = 'Related Videos';
		$this->data['gr_name'] = 'related';
		$this->data['feed'] = $video->relatedVideos(90);


		return View::make('video.categories.related', $this->data);
	}

	public function requestCategories(){
		$perPage = 6;
	

		$videos = Video::paginate(6);
		$categories = Category::take(6)->get();



		// get only 6 items
		$data = array();
		$perPage = 6; //maximum videos displayed per page.
		
		$disableNext = false;
		$disablePrev = false;

		foreach ($categories as $c) {
			
			$disableNext = count($c->videos) < $perPage;
		}

		/*
		* Author: Asshurim 
		*/
		// Most Viewed
        $mostViewed = Views::with('video')->mostViewed()->take(30)->get();

        // return $mostViewed;
        // Popular
        $popular = VideoLike::popular()->take(30)->get();

        // Recommended Videos
        $recommended = Video::recommended(30);

		$this->data['recentVideos'] = $videos;
		$this->data['categoryVideos'] = $categories;
		$this->data['disableNext'] = $disableNext;
		$this->data['disablePrev'] = $disablePrev;
		$this->data['mostViewed'] = $mostViewed;
		$this->data['popular'] = $popular;
		$this->data['recommended'] = $recommended;

		return View::make('video.categories', $this->data);
	}


	public function videoLikes(){

		if(Input::get('status') == 'get'){
		 	$v = Video::find(Input::get('video_id'));
		 	return array('likes'=>$v->likes(), 'dislikes'=>$v->dislikes());
		}

		
		$row = VideoLike::where('user_id', Auth::user()->id)->where('video_id', Input::get('video_id'))->first();

		// if not exists create one
		if(!$row) $row = VideoLike::create(array('user_id'=>Auth::user()->id));

		$row->video_id = Input::get('video_id');

		// Initialized Data
		switch (Input::get('status')) {

				// Like
					case 'like':
						
						$row->like = 1;
						$row->dislike = 0;

						break;

				//Dislike
					case 'dislike':

						$row->like = 0;
						$row->dislike = 1;

						break;

					case 'unlike':
					
						$row->like = 0;

						break;

					case 'un-dislike':

						$row->dislike = 0;


						break;
	
		}

		// Save Data;;
		$row->save();
		
		if(Input::get('status') == 'like'){

			// Add new feed
			$feed = new ActivityFeed();
			$feed->type_id = ActivityType::where('type_name', 'Like')->first()->id;
			$feed->user_id = Auth::user()->id;
			$feed->activity_id = $row->id;
			$feed->save();
		}		
	}

	public function getPlaylists(){

		$plist = Playlist::all();

		foreach( $plist as $p ){
			$vlist = VideoPlaylist::where('playlist_id' , $p->id)->where('user_id', Auth::user()->id)->get();
			$p->count = $vlist->count();
			
			foreach($vlist as $v){
				$p->video_id = $v->video_id;
			}
		}

		$this->data['video'] = Video::find( Input::get('video_id') );
		$this->data['playlists'] = $plist;

		return View::make('components.playlists', $this->data);
	}

	public function addToPlaylist(){
		$video_id = Input::get('video_id');

		$result = VideoPlaylist::where('video_id', $video_id)->first();

		if( !empty($result)){
			DB::table('video_playlists')->delete($result->id);
		}

		$videoPlist = new VideoPlaylist();
		$videoPlist->user_id = Auth::user()->id;
		$videoPlist->video_id = $video_id;
		$videoPlist->channel_id = Input::get('channel_id');
		$videoPlist->playlist_id = Input::get('playlist_id');

		$videoPlist->save();

		// Add new feed
		$feed = new ActivityFeed();
		$feed->type_id = ActivityType::where('type_name', 'Playlist')->first()->id;
		$feed->user_id = Auth::user()->id;
		$feed->activity_id = $videoPlist->id;
		$feed->save();

		$data = array('videoPlaylistId' => $videoPlist->id, 'success' => 'Successfully Added!' );
		
		return $data;
	}

	public function reportVideo(){
		$video_id = Input::get('video_id');

		$videoReport = ReportVideo::where('video_id', $video_id)->first();
		$isReported = false;

		if(!empty($videoReport)){
			$isReported = true;
		}

		$reports = ReportStatus::all();

		$this->data['videoReport'] = $videoReport;
		$this->data['isReported'] = $isReported;
		$this->data['reports'] = $reports;
		$this->data['video'] = Video::find( $video_id );
		
		return View::make('components.reportvideo', $this->data);
	}

	public function reportVideoTo(){
		$video_id = Input::get('video_id');

		$videoReport = ReportVideo::where('video_id', $video_id)->first();

		if( empty($videoReport)){
			$report = new ReportVideo();
			$report->report_id = Input::get('report');
			$report->video_id = $video_id;
			$report->user_id = Auth::user()->id;
			$report->save();

			return array('success' => 'Successfully Reported');
		}

		return array('error' => 'Unexpected Error');

		
	}

	public function paginateVideos(){
		$category = Input::get('category');
		$perPage = Input::get('per_page');
		$page = Input::get('page');

		$offset = $page * $perPage - $perPage;

		if($category == 'Recent'){
			if(Auth::check()){
				$videos = Video::
				leftJoin('channels', 'videos.id', '=', 'channels.video_id')
				->leftJoin('user_channels', 'channels.channel_id', '=', 'user_channels.channel_id')
				->where('user_channels.user_id', '=', Auth::user()->id )
				->orderBy('videos.created_at', 'desc')
				->take( $perPage )
				->offset( $offset )
				->get();
			}else{
				$videos = Video::
				leftJoin('video_categories', 'videos.id', '=', 'video_categories.video_id')
				->leftJoin('categories', 'video_categories.category_id', '=', 'categories.id')
				->orderBy('videos.created_at', 'desc')
				->take( $perPage )
				->offset( $offset )
				->get();	
			}
			
		}
		else{
			if(Auth::check()){
				$videos = Video::
				leftJoin('video_categories', 'videos.id', '=', 'video_categories.video_id')
				->leftJoin('categories', 'video_categories.category_id', '=', 'categories.id')
				->leftJoin('channels', 'videos.id', '=', 'channels.video_id')
				->leftJoin('user_channels', 'channels.channel_id', '=', 'user_channels.channel_id')
				->where('user_channels.user_id', '=', Auth::user()->id )
				->where('categories.category_name', '=', $category)
				->orderBy('videos.created_at', 'desc')
				->take( $perPage )
				->offset( $offset )
				->get();
			}else{
				$videos = Video::
				leftJoin('video_categories', 'videos.id', '=', 'video_categories.video_id')
				->leftJoin('categories', 'video_categories.category_id', '=', 'categories.id')
				->where('categories.category_name', '=', $category)
				->orderBy('videos.created_at', 'desc')
				->take( $perPage )
				->offset( $offset )
				->get();
			}
			
		}

		return Response::json(array(
			'page' => $page,
			'category' => $category,
			'data' => $videos->toArray(),
			'total' => count($videos),
			'disableNext' => count($videos) < $perPage, 
			));
	}




	

	public function postTest(){
		//Util::trace(json_decode(Input::get('tagData')));
	}


	// get recent videos by user id
	private function getRecentVideos( $userID ){

		$channel_id = UserChannel::where('user_id', $userID )->first()->channel_id;

		//recent
		$channels = Channel::where('channel_id', $channel_id)->orderBy('created_at','DESC')->take(6)->get();
		$videos = array();
		foreach($channels as $c){
			if($c->video){
				$videos[] = $c->video;
			}
		}

		return $videos;
	}

	private function getCategoryVideos( $userID = '' ){

		$videos = VideoObject::getVideosByCategories();

		$data = array();

		//arrange by category
		if( count($videos) > 0 ){
			foreach( $videos as $v ){
				if( !empty($v->category_name)){ // if category is not empty

					if( empty( $userID ) ){ // if no user id

						$data[$v->category_name][] = $v; 
					}else{
						if( $userID == $v->user_id ){ // if user id is equal to parameter
						
							$data[$v->category_name][] = $v;
						
						}
					}		
				}
			}
		}

		$videos = $data;

		return $videos;
	}

	public function getUserStats(){
		if( Input::has('user_id') ){
			$user = User::find( Input::get('user_id') );

			$totalSubscribers = ChannelSubscribe::getTotal( $user );

			$totalVideos = count( Video::getAllVideos($user) );

			return Response::json( array('videos' => $totalVideos, 'subscribes' => $totalSubscribers ) );
		}
		
	}

	public function getVideoTags(){
		if( Input::has('video_id') ){
			$video_id = Input::get('video_id');

			$video = Video::find( $video_id );
			if($video){
				$tags = $video->tags;

				return Response::json( $tags );
			}
		}

		return Response::json( array() );
	}
}