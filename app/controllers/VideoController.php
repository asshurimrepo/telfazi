	<?php
	class VideoController extends BaseController{
		// List of actions that are not allowed for the guess.
	    protected $whitelist = array(
	        'video',
            'watchVideo',
            'showVideosByTag',
            'viewCategory',
            'showBrowseVideos',
            'browseSingleFeature',
            'browseVideos',
            'browseVideosPost',
            'showHighlights',
	    );
	 
		public function watchVideo($id = null){
			$video = Video::where('seo_url',$id)->orWhere('id',$id)->first();

			if(empty($id) || empty($video)){
				return Response::view('errors.notfound', $this->data, 404);
			}

			//record watch videos
			$this->recordWatch( $id ); 

			//date
			$videoDate = new DateTime( $video->getCreatedAt() ); 
			$video->uploaded_at = $videoDate->format('F d, Y');

			// Recommended Videos
	        // Generate Random Feed if not Logged In
	        if(Auth::check()){
	         // Generate Random Video Feed filtered by Tags..
	         $recommended = Auth::user()->recommendedVideos();
	        }else{
	         // Generate Random
	         $recommended = Video::with('views')->take(14)->orderBy(DB::raw('RAND()'))->get();
	        }
	        
	 		//$recommended = Video::recommended(30); 		
			$mostViewed = Video::mostViewed(30);
	        

			// Save Viewers
			$ip_address = Request::getClientIp();
			if(Video::find($id) && !Views::where('video_id', $id)->where('ip_address', $ip_address)->count()){
				Views::create(array(
					'video_id'=>$id,
					'ip_address'=>$ip_address,
					'info'=>$_SERVER['HTTP_USER_AGENT']
				));
			}
			
			$this->data['related'] = array();
			$this->data['recommended'] = $recommended;
			$this->data['mostViewed'] = $mostViewed;
			$this->data['playlists'] = Playlist::all();
	        $this->data['video'] = $video;
			$this->data['pageTitle'] = $video->getTitle();
			
			return View::make('video.watch', $this->data);
		}
		public function video( $id ){
			
			//get the video by id
		 	$video = Video::findOrFail( $id );
		
	        //tags
			$video->tags = json_decode(Util::noSlash( $video->tags ) );

			//record watch videos
			$this->recordWatch( $id ); 


			//date
			$videoDate = new DateTime( $video->created_at ); 
			$video->uploaded_at = $videoDate->format('F d, Y');


			// Recommended Videos
	        // Generate Random Feed if not Logged In
	        if(Auth::check()){
	         // Generate Random Video Feed filtered by Tags..
	         $recommended = Auth::user()->recommendedVideos();
	        }else{
	         // Generate Random
	         $recommended = Video::with('views')->take(14)->orderBy(DB::raw('RAND()'))->get();
	        }
	        
	 		$recommended = Video::recommended(30);


	 		
			$this->data['recommended'] = $recommended;
			$this->data['playlists'] = Playlist::all();
	        $this->data['video'] = $video;
	        

			return View::make('video.videoplayer', $this->data);
		}
		public function showVideosByTag( $tagName ){
			
			$tag = Tag::where('name', $tagName)->first();
			
			if( empty($tagName) || empty($tag)){
				return Response::view('errors.notfound', $this->data, 404);
			}

			$perPage = 30;


			//get videos by tag id
			$videos = Video::tagVideos( $tag->id )->get();

            $this->data['category_id'] = 0;
            $this->data['is_category'] = false;
			$this->data['tag_id'] = $tag->id;
			$this->data['perPage'] = $perPage;
			$this->data['heading'] = 'Tag: ' .$tag->name;
			$this->data['slug'] = 'tag';
			$this->data['videos'] = $videos;
			$this->data['enable_featuring'] = false;
			return View::make('components.videos.browse.videos_browse_tags', $this->data);
		}
		public function requestEditVideo(){

			$videoData = json_decode( Util::noSlash(  Input::get('videoData') ) );

			
			// Get the categories to be use for the dropdown
			$categories = DB::table('categories')->get();

			$temp = array();

			if(count($categories) > 0){
				foreach($categories as $cat){
					$temp[$cat->id] = $cat->category_name;
				}
			}

			$categories = $temp;

			$this->data['categories'] = $categories;
			$this->data['counter'] = Input::get('counter');
			$this->data['video'] = $videoData;
			$this->data['thumb'] = $videoData->thumb;

			return View::make('video.edit', $this->data);
		}
		private function recordWatch( $video_id ){
			if( Auth::check() ){

				$user_id = Auth::user()->id;

				$video = WatchedVideo::where('user_id', $user_id)->where('video_id', $video_id)->first();

				if(empty($video)){
					$watched = new WatchedVideo();
					$watched->user_id = $user_id;
					$watched->video_id = $video_id;
					$watched->save();
				}
			}
		}
		public function viewCategory(){

			$soccerVids = Video::byCategory( 1 );

	        $automotiveVids = Video::byCategory( 2 );

	        $this->data['soccerVids'] = $soccerVids;
	        $this->data['automotiveVids'] = $automotiveVids;

			return View::make('video.category', $this->data);
		}
	private function reArrayFiles( $file_post ) {

		    $file_ary = array();
		    $file_count = count($file_post['name']);
		    $file_keys = array_keys($file_post);

		    for ($i=0; $i<$file_count; $i++) {
		        foreach ($file_keys as $key) {
		            $file_ary[$i][$key] = $file_post[$key][$i];
		        }
		    }

		    return $file_ary;
		}

	}