<?php
class VideoBrowseController extends BaseController{
    protected $whitelist = array(
        'showBrowseVideos',
        'browseSingleFeature',
        'browseVideos',
        'browseVideosPost',
    );

    protected $per_page = 30;
    protected $page = 1;

    // Create a view for browse page.
    public function showBrowseVideos( $filter = 'all', $cat_id = null ){
        // check if category exists in the language criteria.
        if($cat_id != null && $this->checkCategoryExists( $cat_id ) == false){
            return Redirect::to('browsevids');
        }

        // featuring video.
        $video = $this->getSingleFeatureVideo( $cat_id );

        $this->data['video'] = $video;
        $this->data['slug'] = $filter;
        $this->data['category_id'] = $cat_id;
        return View::make('video.browse', $this->data);
    }

    // Get videos from a specified category, sorted from the latest.
    public function browseVideos($filter = 'all', $cat_id = null){
        $take = $this->per_page;
        $page = Input::has('page') ? Input::get('page') : $this->page;
        $videos = array();
        $offset = $page * $take - $take;
        $catname = '';
        $is_category = false;

        // get the category name.
        if($cat_id)
            $catname = Category::find($cat_id)->name . ' - ';

        // Filtered By Category
        if($filter == 'category' && $cat_id){
            $cat = Category::with('videos')->find($cat_id);
            $this->data['filter'] = $cat->title;
            $videos = $cat->videos()->take( $take )->offset( $offset )->orderBy('creation_date', 'desc')->get();
            $is_category = true;
        }
        else if( $filter == 'popular'){
            $likes = VideoLike::popular()->orderBy('created_at', 'desc')->take( $take )->offset( $offset )->get();
            foreach($likes as $l){
                if($l->video){
                    $video = $l->video()->byLanguage($this->lang_id)->first();
                    if($video){
                        //if popular is categorized
                        if($cat_id){
                            if($video->videocategory){
                                if($video->videocategory->category_id == $cat_id){ // filter category
                                    $videos[] = $video;
                                }
                            }
                        }else{
                            $videos[] = $video; // normal sorting
                        }
                    }
                }
            }
            $this->data['filter'] = $catname . 'Most Popular';
        }
        else if( $filter == 'newest'){
            echo ' all videos ';

            if($cat_id){
                $videos = Video::whereHas('videocategory', function($q) use ($cat_id) {
                    $q->where('category_id', $cat_id);
                })->take( $take )->offset( $offset )->orderBy('creation_date','desc')->byLanguage($this->lang_id)->get();
            }else{
                $videos = Video::take( $take )->offset( $offset )->orderBy('creation_date','desc')->orderBy(DB::raw('RAND()'))->byLanguage($this->lang_id)->get();
            }

            $this->data['filter'] = $catname . 'Newest';
        }
        else{
            echo ' all videos ';
            // all videos
            $videos = Video::take( $take )->offset( $offset )->orderBy(DB::raw('RAND()'))->byLanguage($this->lang_id)->get();

            $this->data['filter'] = 'All Videos';
        }
        if($filter == 'all')
            $filter = 'category';

        $url_to_scroll = trim(implode('/', [ 'browse', $filter, $cat_id ]), '/');
        $next_page =  $page + 1;
        $this->data['perPage'] = $take;
        $this->data['slug'] = $filter;
        $this->data['videos'] = $videos;
        $this->data['category_id'] = $cat_id;
        $this->data['next_page'] = $next_page;
        $this->data['url_segments'] = trim(implode('/', [ 'browsevids', $filter, $cat_id ]), '/');
        $this->data['url_to_scroll'] = $url_to_scroll.'?scroll=true?&page='.$next_page;
        $this->data['is_category'] = $is_category;

        //for testing..
        //echo 'offset: ' . $offset . '<br><br>';
        /*$videos->each(function( $video ){
            echo 'id: ' . $video->id . '<br>';
            echo 'video: ' . $video->title . '<br>';
            echo 'category: ' .$video->category->title . '<br>';
            echo 'date: ' . $video->getCreatedAt('F d, Y') . '<br>';
            echo '<br>';
        });*/

        if(Input::has('scroll') && Input::get('scroll') == true){
            if( count($videos) > 0 ){
                return View::make('components.videos.browse.collection', $this->data);
            }else{
                return null;
            }
        }
        return Response::json( ['html' => View::make('components.videos.browse.videos_browse', $this->data )->render() ]);
    }

    public function browseVideosPost(){
        $page = Input::get('getLastPage');
        $cat_id = Input::get('category_id');
        $filter = Input::get('filter');
        $tag_id = Input::get('tag_id');
        $perPage = 30;
        $html = '';
        $videos = array();

        $offset = $page * $perPage - $perPage;


        //TODO:: create a code to get videos per user channel in the user channel page.
        $videos = Video::take( $perPage )
            ->offset( $offset )
            ->byLanguage($this->lang_id)
            ->get();

        if($cat_id){
            $videos = Video::whereHas('videocategory', function( $q ) use ($cat_id){
                $q->where('category_id', $cat_id);
            })->take( $perPage )
                ->offset( $offset )
                ->byLanguage($this->lang_id)
                ->get();
        }
        if($filter == 'mustwatch'){
            $videos = Video::whereRaw("videos.creation_date BETWEEN CURDATE() + INTERVAL -2 DAY AND CURDATE()")
                ->take( $perPage )
                ->offset( $offset )
                ->byLanguage( $this->lang_id )
                ->get();
        }
        if( $filter == 'newest' ){

        }
        if($filter == 'tag'){
            $videos = Video::tagVideos( $tag_id )
                ->take( $perPage )
                ->offset( $offset )
                ->get();
        }




        $data = array();
        if( count($videos) > 0 ){
            foreach( $videos as $i => $v ){

                $html .= View::make('layouts.home.carousel.vidsmall', array('v' => $v));

            }
        }

        return $html;
    }

    //Repositories
    // Get a single featuring video from specified category.
    public function getSingleFeatureVideo( $cat_id = null ){

        // featuring video.
        if($cat_id){
            $video = Video::whereHas('videocategory', function($q) use ($cat_id) {
                $q->where('category_id', $cat_id);
            })
                ->remember(60)
                ->orderBy(DB::raw('RAND()'))
                ->orderBy('creation_date','desc')
                ->take(10)
                ->byLanguage($this->lang_id)
                ->first();
        }else{
            $video = $this->getRandomVideo();
        }

        return $video;
    }

    // Get a random from the latest 10 videos.
    public function getRandomVideo(){
        return Video::orderBy(DB::raw('RAND()'))
            ->orderBy('creation_date','desc')
            ->take(10)
            ->byLanguage($this->lang_id)
            ->first();
    }

    // Check if category exists and if category is in the same language
    public function checkCategoryExists( $cat_id ){
        $categories = Category::where('language', $this->lang_id)->where('id', $cat_id)->first();
        if($categories){
            return true;
        }
        return false;
    }
}