<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Illuminate\Database\Eloquent\ScopeInterface;

class Video extends Eloquent{
	use SoftDeletingTrait;
	//use DefaultScopeTrait;

	protected $table = 'videos';

	protected $softDelete = true;

	protected $rules = array(
		'title' => 'required|between: 4, 30',
		'description' => 'required',
		'file' => 'required'
	);

	protected $guarded = array('id');

	protected $with_no_status = false;

	public function withNoStatus( $bool ){
		$this->with_no_status = $bool;
	}
	public function newQuery( $excludeDeleted = true )
	{
		if($this->with_no_status == false){
			return parent::newQuery()->whereStatus(2);
		}else{
			return parent::newQuery();
		}
	}

	/*public function scopeWithUnpublished( $query ){
		return $query->orWhere('published', 0);
	}*/

	/*public function scopeWithUnpublished( $query ){
		return $query->orWhere('published', 0);
	}*/

	
	public function mapData()
	{
		$vd = explode('.',$this->duration);
		$this->url = 'https://s3-us-west-2.amazonaws.com/vidorabia/'. urlencode($this->video_url);
		$this->video_duration = $vd[0];

		if($this->published && $this->is_stream){
			
		}		

		return $this;
	}

	public function gotoUrl(){
		if( $this->is_stream ){
			return url('live/'.$this->id);
		}
		else {
			if(is_null($this->seo_url) == false || empty($this->seo_url) == false){
				return url('watch/'.$this->seo_url);
			}
		}

		return url('watch/'.$this->id);
	}

	public function getVideoURL(){
		$url = $this->flv_url ? $this->flv_url : $this->video_url;
		return 'https://s3-us-west-2.amazonaws.com/vidorabia/'.urlencode( $url );
	}

	public function getMobileURL(){
		return 'https://s3-us-west-2.amazonaws.com/vidorabia/'.urlencode($this->video_url);
	}

	public function getAuthIdentifier()
	{
	  return $this->getKey();
	}

	public function getCreatedAt($format = ''){
		if(empty($format)){
			return $this->created_at = $this->creation_date;
		}		
		else{
			return date($format, strtotime($this->creation_date) );
		}
	}

	public function channel(){
		return $this->hasOne('Channel', 'video_id', 'id');
			
	}

	public function categoryName(){
		if($this->videocategory) {
			$category = Category::find( $this->videocategory->category_id );
			if ($category){
				return $category->title;
			}
		}
		return '';
	}

	public function videocategory()
	{
		return $this->hasOne('VideoCategory', 'video_id', 'id');
	}

	public function views()
	{
		return $this->hasMany('Views', 'video_id', 'id');
	}

	public function user(){
		if($this->channel->userchannel){
			return $this->channel->userchannel->user;
		}
		
		return '';
	}

	public function translate(){
		return $this->hasOne('VideoTranslate', 'video_id', 'id');
	}

	// display the name of the owner of this video
	public function getDisplayName(){
		if($this->channel){
			if($this->channel->userchannel->user->isAdmin() == false){
				return $this->channel->userchannel->user->getDisplayName();
			}
		}
		
		return '';
	}

	public function response(){
		if(Auth::check()){
			$video_id = $this->getKey();
			$user_id =  Auth::user()->id;

			$data = VideoLike::where( 'user_id', $user_id )->where('video_id', $video_id )->first();
			if(empty($data)){
				return false;
			}
			return $data;
		}
	}

	public function hasLiked( ){
		if(Auth::check()){

			$video_id = $this->getKey();

			$user_id =  Auth::user()->id;

			$like = VideoLike::where( 'user_id', $user_id )->where('video_id', $video_id )->first();

			if( empty($like))
				return false;

			if($like->like)
				return true;
			else
				return false;

		}
	}

	public function hasDisliked(){
		if(Auth::check()){
			$video_id = $this->getKey();

			$user_id =  Auth::user()->id;

			$like = VideoLike::where( 'user_id', $user_id )->where('video_id', $video_id )->first();

			if( empty($like))
				return false;

			if($like->dislike)
				return true;
			else
				return false;
		}
	}

	public function likes(){
		$video_id = $this->getKey();

		$i = 0;
		$like = VideoLike::where('video_id', $video_id)->get();
		foreach($like as $l){
			if($l->like){
				$i++;
			}
		}
		
		return $i;
	}

	public function dislikes(){
		$video_id = $this->getKey();

		$i = 0;
		$like = VideoLike::where('video_id', $video_id)->get();
		foreach($like as $l){
			if($l->dislike){
				$i++;
			}
		}
		
		return $i;
	}

	public function relatedVideos( $take = 6 ){

		$videos = Video::leftJoin('video_category', 'videos.id', '=', 'video_category.video_id')
			->leftJoin('categories', 'video_category.category_id', '=', 'categories.id')
			->where('videos.id','!=', $this->id)
			->where('categories.id', $this->category->id)
            ->select(DB::raw('categories.title as category_title, videos.*'))
        	->take( $take )
        	->orderby('creation_date', 'desc')
        	->get();

    	return $videos;	
	}

	 function tags(){
		return $this->belongsToMany('Tag', 'video_tag');
	}

	public function videoTags(){
		return $this->hasMany('VideoTag');
	}

	public static function tagVideos( $tag_id ){
		$videos = Video::leftJoin('video_tag', 'videos.id', '=', 'video_tag.video_id')
			->leftJoin('tags', 'video_tag.tag_id', '=', 'tags.id')
			->where('tags.id', $tag_id)
            ->select(DB::raw('videos.*'))
        	->orderby('creation_date', 'desc');


    	return $videos;
	}

	public function getViews(){
		return $this->views()->count() + $this->views;
		//return $this->views()->count();
	}

	public static function featured( $take = 18 ){
		// The display listing should be random. It should be mix like must watch but this section will fetch only for daily upload.
		return Video::orderBy(DB::raw('RAND()'))->take( $take )->byLanguage(Session::get('lang_id'))->get();
	}

	// This function will display recommended videos
	public static function recommended($take = 6)
	{
		// Recommended Videos
        // Generate Random Feed if not Logged In
        /*if(Auth::check()){
        	// Generate Random Video Feed filtered by Tags..
        	$recommended = Auth::user()->recommendedVideos($take);
        }else{
        	// Generate Random
        	$recommended = Video::with('views')->take($take)->byPublished()->orderBy(DB::raw('RAND()'))->get();
        }*/

        // Generate Random
    	$recommended = Video::with('views')
    		->take($take)
			->byLanguage(Session::get('lang_id'))
    		->orderBy(DB::raw('RAND()'))
    		->remember(10)->get();

        return $recommended;
	}

	public function isPublished(){
		if($this->published == 1 && $this->is_stream == 0){
			return $this;
		}
	}

	public function isLanguage($id){
		if($this->videocategory->category->language == $id){
			return $this;
		}
	}

	public function categories(){
		return $this->belongsToMany('Category','video_category');
	}

	public function getCategoryAttribute()
	{
	  return $this->categories->first(); // not addresses()->first(); as it would run the query everytime
	}

	public function scopeByPublished( $query ){
		return $query->where('published', 1)->where('is_stream', 0);
	}

	public function scopePublished( $query ){
		$query->where('published', '1');
	}

	public function scopeStream( $query ){
		$query->where('is_stream', '1');
	}

	public function scopeByLanguage( $query, $lang_id = 2 ){
		$query->leftJoin('video_category', 'videos.id', '=', 'video_category.video_id')
			->leftJoin('categories', 'video_category.category_id', '=', 'categories.id')
			->where('categories.language', $lang_id)
            ->select(DB::raw('categories.title as category_title, videos.*'));
	}

	// This function will display videos by most viewed
	public static function mostViewed($take = 6){
		$videos = array();

		$vids = Views::with('video')->mostViewed()->take( $take )->get();
	
		if( $vids->count() > 0){
			foreach( $vids as $v ){
				if(isset($v->video->id)){
					$video = Video::where('videos.id', $v->video->id)->byLanguage(Session::get('lang_id'))->first();
					
					if($video){
						$videos[] = $video;
					}
				}
			}
		}

		return $videos;
	}


	// This function will display videos by most popular
	public static function mostPopular($take = 6){
		$videos = array();

		if($take == 'all'){
			$vids =  VideoLike::popular()->get();
		}else{
			$vids =  VideoLike::popular()->take( $take )->get();
		}		

		if( $vids->count() > 0){
			foreach( $vids as $v ){
				if(isset($v->video->id)){
					$video = Video::find($v->video->id);
					
					if($video && $video->isPublished() && $video->isLanguage(Session::get('lang_id'))){
						$videos[] = $video;
					}
				}
			}
		}

		return $videos;
	}

	// This function will display videos by category
	public static function byCategory( $cat_id ){
		$videos = array();

		$cat = Category::with('videos')->find($cat_id);

		$videos = $cat->videos;

		return $videos;
	}

	public function checkTranslate(){
		if($this->translate){
			if($this->translate->language->slug == Session::get('lang')){
				return true;
			}
		}

		return false;
	}

	public function getTitle( $limit = '' ){
		$title = '';

		if($this->checkTranslate())
			$title = $this->translate->title;
		else
			$title = $this->title;
			
		if(empty($limit))
			return $title;
			
		else
			return str_limit($title, $limit, '');			
	}


	public function getDescription( $limit = '' ){
		$desc = '';

		if($this->checkTranslate())
			$desc = $this->translate->description;
		else
			$desc = $this->description;
			
		if(empty($limit))
			return $desc;
			
		else
			return str_limit($desc, $limit, '...');		
	}

	public function getThumbnail($index = 0){
		$prefix = array('https://s3-us-west-2.amazonaws.com/vidorabia/', 'https://s3-us-west-2.amazonaws.com/vidorabia.test/');
		
		//for streaming
		if($this->is_stream){
			return asset('uploads/streamers/'.$this->thumbnail_url);
		}

		//for regular vids
		$vts = VideoThumbnailSmall::where('video_id', $this->id)->first();
		if( $vts ){
			return 'https://s3-us-west-2.amazonaws.com/vidorabia/'. $vts->key;
		}else{
			if(empty($this->thumbnail_url) == false){
				return "". $prefix[ $index ].urlencode($this->thumbnail_url)."";
			}else{
				return asset('assets/img/thumb3.jpg');
			}
		}
	}

	public function getDuration(){
		$vd = explode('.',$this->duration);
		if($this->duration)
			return $vd[0];
		else
			return '00:00';
	}

	public function translations()
	{
		return $this->hasMany('VideoTranslate');
	}

	public function getStreamCategory(){
		$serc = StreamerCategory::where('video_id', $this->id)->first();
		$sc = StreamCategory::find($serc->category_id);
		return $sc;
	}

	public static function getAllVideos( $user ){

		$videos = array();

		//first check if there are channels in a user
		$channels = UserChannel::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

		if( count( $channels) <= 0 ){
			return array(); // return empty
		}
		
		$channels = Channel::where(function($query) use ( $user ) {
            
            $channels = UserChannel::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        	
            $ids = array();

            //get channel ids of the user.
            foreach( $channels as $c ){
                $ids[] = $c->id;
            }

            // loops the where query.       
            foreach($ids as $i){
                $query->orWhere('channel_id', $i ); 
            }
            
        })->orderBy('created_at', 'desc')->get();

        if ( count($channels) > 0 ) {
            foreach ($channels as $key => $c) {
                if($c->video){
                    $video = Video::find($c->video->id);
            
                    if($video){
                        $videos[] = $video;
                    }
                }
            }

            return $videos;
        }
        
	}



}