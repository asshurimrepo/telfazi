<?php
class FrontController extends BaseController{
    
    // List of actions that are not allowed for the guess.
    protected $whitelist = array(
        'login', 'home', 'log_auth', 'log_fb', 'getVideosBy', 'showMustWatch', 'getFeatureCategory', 'getFeatureLiveStream', 'getFeatureVideos'
    );

    public function home(){  

        $this->data['featured'] = Video::featured(27);

        $recommended = Video::recommended(20);
        $mostViewed = Video::mostViewed(20);

        $channels = UserChannel::take(4)->get();

        $this->data['channels'] = $channels;
        $this->data['recommended'] = $recommended;
        $this->data['mostViewed'] = $mostViewed;
        
        //return View::make( 'home', $this->data );

        return View::make( 'hometranspa', $this->data );
    }

    public function showMustWatch(){
        $take = 30;

        $day_interval = 5;
        $videos = array();
        
        while( empty($video) ){

            $category = Category::where('language', Session::get('lang_id'))->orderBy(DB::raw('RAND()'))->first();
            
            // featuring video.
            $video = Video::whereHas('videocategory', function($q) use ( $category ) {
                        
                        $q->where( 'category_id', $category->id );
                    })
            
            //->whereRaw("videos.creation_date BETWEEN CURDATE() + INTERVAL -$day_interval DAY AND CURDATE()")
            ->orderBy(DB::raw('RAND()'))
            ->orderBy('creation_date', 'desc')
            ->take(10)
            ->byLanguage($this->lang_id)
            ->first();

            // get videos from 5 days ago
            $videos = Video::whereHas('videocategory', function($q) use ( $category ) {
                        
                        $q->where( 'category_id', $category->id );
                    })
            //->whereRaw("videos.creation_date BETWEEN CURDATE() + INTERVAL -$day_interval DAY AND CURDATE()")
            ->orderBy('creation_date', 'desc')
            ->byLanguage($this->lang_id)
            ->take( $take )
            ->get();
        }


        $this->data['perPage'] = $take;
        $this->data['video'] = $video;
        $this->data['videos'] = $videos;
        $this->data['slug'] = 'mustwatch';

        return View::make('mustwatch', $this->data);
    }

    public function getVideosBy( $sortby = 'all' ){
        $sortby =  Request::segment(2);
        $videos = array();

        if($sortby == 'all'){
            $videos = Video::all();
        }

        if($sortby == 'mostviewed'){
            $videos = Video::mostViewed(30);
        }

        if($sortby == 'popular'){
            $videos = Video::mostPopular(20);
        }
        
        //Util::trace($videos);

        $this->data['type'] = 'browe';
        $this->data['videos'] = $videos;
        return View::make('video.searchresult', $this->data);
    }

    // Get some videos to be featured in the home page
    public function getFeatureVideos(){
        $data['html'] = View::make('layouts.home.carousel.feature', ['videos'=>  Video::featured(27), 'carousel_name' => 'carousel-feature'] )->render();

        return Response::json( $data );
    }

    // Get some videos from the specified category to be featured in the home page
    public function getFeatureCategory(){
        $cat_id = Input::get('cat_id');
        $cat = Category::find( $cat_id );
        $videos = $cat->videos()->remember(60)->orderBy('creation_date','desc')->take( 36 )->get();

        $videos = $videos->filter(function( $video ){
            return $video->isLanguage( Session::get('lang_id') );
        });

        $data['html'] = View::make('layouts.home.carousel.category', ['title'=> $cat->name, 'videos' => $videos, 'catUrl' => url('browse/category/'.$cat->id), 'carousel_name' => 'carousel-'.$cat->id])->render();

        return Response::json( $data );
    }

    // Get some videos from the live streams to be featured in the home page
    public function getFeatureLiveStream(){
        $videos = new Video();
        $videos->withNoStatus(true);
        $videos = $videos->stream()->orderBy('created_at', 'desc')->take(27)->get();


        $data['html'] = View::make('layouts.home.carousel.feature', [
            'videos' => $videos,
            'carousel_name' => 'carousel-livestream',
            'is_livestream' => true ])->render();

        return Response::json( $data );
    }

    public function user($username){
        if( ! Auth::check()){
            return Redirect::to('login')->with('error', 'You are not allowed');
        }       
       
        $username = $username;
        $user = DB::table('users')->where('username', $username)->first();
        $user->id_code = Crypt::encrypt( $user->id );
        $user->role = Delegate::getRole( Auth::user() );
        $user->channelID =  VideoObject::getUserChannel( $user->id );

        
        $video = VideoObject::getUserVideosByFirst($user->channelID); // get the most recent video.
        if($video){
            $video->tags = json_decode(Util::noSlash( $video->tags ) );
        }

        // Get videos from user channel sorted by latest 
        $videoList = VideoObject::getVideosByChannel($user->channelID);

        $temp = array();
        if(count($videoList) > 0){
            foreach($videoList as $v){
                $v->author = $user->username;

              
                // list all the videos except the one being played
                if($v->video_id != $video->video_id){ 
                    $temp[] = $v;
                }
            }
        }

        $videoList = $temp;

         // Most Viewed
        $mostViewed = Views::with('video')->mostViewed()->take(30)->get();

        // Popular
        $popular = VideoLike::popular()->take(30)->get();

        // Get the Lucky Video
        $mergeResults = array_merge($mostViewed->toArray(), $popular->toArray());
        $lucky_video = $mergeResults[array_rand($mergeResults)]['video'];

 
        
        $this->data['video'] = $video;
        $this->data['videoList'] = $videoList;
        $this->data['user'] = $user;
        $this->data['channelID'] = $user->channelID; // default channel
        $this->data['lucky_video'] = $lucky_video;

       
    }

    public function login(){
        if(Auth::check()){
            
            return Redirect::to('mytv');
        }
        
        return View::make('frontend/login', $this->data);
    }

    public function log_auth(){
        
        if(isset($_POST['sign_in'])){
            
            $inputs = Input::all();

            $rules = array(
                'username' => 'Required',
                'password' => 'Required'
                );
            
            $validator = Validator::make($inputs, $rules);

            $validate = $validator->passes();

            if($validate){

                $username = Input::get('username');
                $password = Input::get('password');

                // Check authentication
                if(Auth::attempt(array('username' => $username, 'password' => $password))){
                     
                    // Redirect to profile.
                    return Redirect::to('/');
                
                }else{
                    
                    return Redirect::to('login')->with('error', '<b>Incorrect Credentials! </b>The credentials you entered does not belong to any account.');
                } 
            }
            else{

                return Redirect::to('login')->withInputs($inputs)->withErrors($validator->getMessageBag());
            }
        }
    }

    public function log_fb(){
        $response = Input::get('code');
        $code = json_decode( $response );

        // user logging must have a valid and working email.
        if(!empty($response) && isset($code->email)){
            $user = User::where('email', $code->email)->first();

            if(!empty($user)){

                Auth::login($user);

                Session::set('facebook_data', $code);
            }else{
                //new user
                $user = new User();
                $user->email = $code->email;
                $user->username = $code->first_name.$code->last_name;
                $user->first_name = $code->first_name;
                $user->last_name = $code->last_name;
                $user->type = 3;
                $user->save(); 

                // Create a User Channel
                $userChannel = new UserChannel();
                $userChannel->channel_id = uniqid();
                $userChannel->user_id = $user->id;
                $userChannel->save();

                // Create new Assigned Role
                $assignedRole = new AssignedRole();
                $assignedRole->user_id = $user->id;
                $assignedRole->role_id = Role::where('slug', 'regular')->first()->id;
                $assignedRole->save();

                // Create User Information
                $userInfo = new UserInformation();
                $userInfo->user_id = $user->id;
                $userInfo->save();

                //Send email upon registration
                $this->data['user'] = $user;
                Mail::send('emails.registered',  $this->data,  function($message)  use ($user)
                {
                    $message->to($user->email, 'Telfazi')->subject('Welcome to Telfazi');
                }); 

                Auth::login($user);
            }

            $sess = Session::set('login_type', 'facebook');
            $this->data['login_type'] = Session::get('login_type');
        }else{
            $data['status'] = 'error';
            $data['status_message'] = '<i class="fa fa-exclamation-triangle"></i> Your facebook email is not working.';

            return Response::json($data);
        }
    }

    public function logout(){
        // Log the current user out.
        
        Auth::logout();

        return Redirect::to('/')->with('success', 'You are successfully logged out.');
    }
}