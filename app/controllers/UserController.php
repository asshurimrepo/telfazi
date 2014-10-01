<?php
class UserController extends BaseController{
    // List of actions that are not allowed for the guess.
    protected $whitelist = array(
        //'user',
        'register_user',
        'store_user',
        'userDashboad',
        'myChannels',
        'myLikedVideos'
    );

    private function getUser($username){

        if($username){
            $user = User::where('username', $username)->first();
        }else{
            $user = Auth::user();    
        }

        return $user;
    }
    public function userDashboad( $username = "" ){

        $user = $this->getUser($username);

        $take = 5;
        
        $feeds = ActivityFeed::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->take( $take )
        ->get();

        $total = count($feeds);

        $feeds = $feeds->filter(function( $feed ){
            if($feed->user)
                return $feed;
        });  

        $this->data['take'] = $take;
        $this->data['isViewing'] = true;
        $this->data['feeds'] = $feeds;
        $this->data['feed_total'] = $total;
        $this->data['user'] = $user;
        $this->data['channelID'] = UserChannel::where('user_id', $user->id)->first()->channel_id; // default channel use for upload
        
        return View::make('user/dashboard', $this->data);
    }
    public function myDashboad( $username = "" ){
        if(Auth::check()){
            if($username == Auth::user()->username){
                return Redirect::to('mytv');
            }
        }else{
             $user = $this->getUser($username);
        }
        
        
        $user = $this->getUser($username);

        $isViewing = $username ? true : false;
        $take = 5;
        
        if($isViewing){
            $feeds = ActivityFeed::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->take( $take )
                ->get();
        }else{
            $feeds = ActivityFeed::allFeeds($user->id)
                ->orderBy('created_at', 'desc')
                ->take( $take )
                ->get();
        }
        $total = count($feeds);

        $feeds = $feeds->filter(function( $feed ){
            if($feed->user)
                return $feed;
        });   


        $this->data['take'] = $take;
        $this->data['isViewing'] = $isViewing;
        $this->data['feeds'] = $feeds;
        $this->data['feed_total'] = $total;
        $this->data['user'] = $user;
        $this->data['channelID'] = UserChannel::where('user_id', Auth::user()->id)->first()->channel_id; // default channel use for upload
        
        return View::make('user/dashboard', $this->data);
    }


    public function myDashboardManage(){

        if(Input::get('post')){
            // Add new post
            $post = new Post();
            $post->user_id = Auth::user()->id;
            $post->content = Input::get('post');
            $post->save();

            // Add new feed
            $feed = new ActivityFeed();
            $feed->type_id = ActivityType::where('type_name', 'Post')->first()->id;
            $feed->user_id = Auth::user()->id;
            $feed->activity_id = $post->id;
            $feed->save();

            return Redirect::back();
        }

        if(Input::get('feed_more')){
            $user_id = Crypt::decrypt(Input::get('user_id'));
            $page = Input::get('page');
            $isViewing = Input::get('is_viewing');
            $perPage = Input::get('take');

            $user = User::find( $user_id );

            $offset = $page * $perPage - $perPage;

            if($isViewing){
                $feeds = ActivityFeed::where('user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->take( $perPage )
                    ->offset( $offset )
                    ->get();
            }else{
                $feeds = ActivityFeed::allFeeds($user_id)
                    ->orderBy('created_at', 'desc')
                    ->take( $perPage )
                    ->offset( $offset )
                    ->get();
            }

            $total = count($feeds);

            $feeds = $feeds->filter(function( $feed ){
                if($feed->user)
                    return $feed;
            }); 

            $this->data['feed_total'] = $total;
            $this->data['take'] = $perPage;
            $this->data['user'] = $user;
            $this->data['feeds'] = $feeds;
            $this->data['isViewing'] = $isViewing;



            if($feeds->count() > 0 ){
                return View::make('user.feed.feed', $this->data);
            }

            return '';
        }

       return Redirect::back()->with('error', 'Opps!, dont be silent');
    }

    public function myProfile(){
        $user = Auth::user();

        $this->data['user'] = $user;

        $this->data['isViewing'] = false;

        return View::make('user.profile', $this->data);
    }

    public function myChannels( $username = "" ){
        $user = $this->getUser($username);
        $isViewing = $username ? true : false;
            

        // get the channels of the user.
        $channels = UserChannel::where('user_id', $user->id)->get();

        if($isViewing){
            $heading = $user->username . ' Channels';
        }else{
            $heading = 'My Channels';
        }
        
        $this->data['isViewing'] = $isViewing; 
        $this->data['heading'] = $heading;
        $this->data['channels'] = $channels;
        $this->data['categories'] = Category::all();
        $this->data['user'] = $user;

        return View::make('user.channels', $this->data);     
    }


    public function createChannel(){
        $validate = UserChannel::validate(Input::all());

        if($validate->passes()){
            $channel = new UserChannel();
            $channel->channel_id = uniqid();
            $channel->user_id = Auth::user()->id;
            $channel->channel_name = Input::get('channel_name');
            $channel->channel_description = Input::get('channel_description');
            $channel->save();


            if(Input::get('category')){
                $chanCat = new ChannelCategory();
                $chanCat->channel_id = $channel->channel_id;
                $chanCat->category_id = Input::get('category');
                $chanCat->save();
            }

            return Redirect::back()->with('success', 'Channel successfully created!');
        }else{
            return Redirect::back()->with('error', 'Do not leave the field empty.');
        }
    }

    public function editChannel( $channel_id ){
        $user = Auth::user();

        //get the channel
        $userChannel = UserChannel::where('channel_id', $channel_id)->first();

        $this->data['channel'] = $userChannel;
        $this->data['user'] = $user;
        $this->data['isViewing'] = false;
        return View::make('user/editChannel', $this->data);
    }

     public function saveChannel(){
        $image = Input::file('image');
        
        return Upload::image( $image );

        $channel = UserChannel::where('channel_id', Input::get('channel_id'))->first();
        
        if($channel){
            $channel->channel_name = Input::get('channel_name');
            $channel->channel_description = Input::get('channel_description');
            $channel->save();


            if(Input::get('category') > 0){
                $chanCat = ChannelCategory::where('channel_id', $channel->channel_id )->first();
                if(! $chanCat ){
                    $chanCat = new ChannelCategory();
                    $chanCat->channel_id = $channel->channel_id;
                }
                $chanCat->category_id = Input::get('category');
                $chanCat->save();
            }

            return Redirect::back()->with('success', 'Channel successfully updated!');
        }
    }

    //get
    public function mySubscriptions( $username = '' ){
        $user = $this->getUser($username);
        $isViewing = $username ? true : false;
        $this->data['isViewing'] = $isViewing;


        $subscriptions = ChannelSubscribe::where('user_id', $user->id)->where('subscribed', true)->get();

        $this->data['heading'] = 'My Subscriptions';
        $this->data['subscriptions'] = $subscriptions;
        $this->data['user'] = $user;

        
        return View::make('user.subscriptions', $this->data);   
    }

    //post
    public function mySubscriptionsManage(){
        if(Input::get('subscription')){
            $sub_id = Input::get('subscription');

            $chanSub = ChannelSubscribe::find($sub_id);

            if($chanSub->user_id == Auth::user()->id ){

                $chanSub->delete();

                return Redirect::back()->with('success','Successfully unsubscribed!');
            }else{
                return Redirect::back()->with('error','Opps, this is not your subscription');
            }
        }

        return Redirect::back()->with('error', 'There is no such action.');
    }
    
    public function myLikedVideos( $username = "" ){
        $user = $this->getUser($username);
        
        $isViewing = $username ? true : false;

        $this->data['isViewing'] = $isViewing;

        $likes = VideoLike::where('user_id', $user->id)->where('like',1)->orderBy('created_at', 'desc')->get();

        $videos = array(); 
        if(count($likes) > 0){
            foreach($likes as $l){
                if($l->video){
                    $videos[] = $l->video;
                }
            }   
        }     
        
        $this->data['heading'] = $isViewing ? 'Liked Videos' : 'My Liked Videos';
        $this->data['videos'] = $videos;
        $this->data['user'] = $user;
        return View::make('user.likedvideos', $this->data);     
    }

    public function likedTable(){

        $user = Auth::user();

        $likes = VideoLike::where('user_id', $user->id)->where('like',1)->orderBy('created_at', 'desc')->get();

        $videos = array(); 
        if(count($likes) > 0){
            foreach($likes as $l){
                $videos[] = $l->video;
            }   
        }     
        
        $this->data['videos'] = $videos;

        $html = '';
        if(count($videos) > 0){
            foreach($videos as $v){
                if($v){
                    $html .= View::make('layouts.home.carousel.vidsmall', array('v' => $v, 'enable_dislike' => true ));
                }
            }    
        }
        
        return $html;

        //return View::make('video.lists.videosliked', $this->data);
    }


    public function myVideos( ){
        $take = 20;
        $videos = array();
        $user = Auth::user(); 

        $videos = Video::getAllVideos( $user );

        $this->data['heading'] = 'My Uploads';
        $this->data['urlback'] = 'mytv/videos'; 
        $this->data['take'] = $take;
        $this->data['isViewing'] = false;
        $this->data['videos'] = $videos;
        $this->data['user'] = Auth::user();

        return View::make('user.myvideos', $this->data);
    }

    public function myVideosPost(){
        $page = Input::get('getLastPage');
        $perPage = 20;
        $html = '';
        $videos = array();

        $offset = $page * $perPage - $perPage;

        $channels = Channel::where(function($query) {
            $user = Auth::user();
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
            
        })->orderBy('created_at', 'desc')->take( $perPage )
                ->offset( $offset )
                ->get();

        if ( count($channels) > 0 ) {
            foreach ($channels as $key => $c) {
                $video = Video::find($c->video->id);
                
                if($video){
                    $videos[] = $video;
                }
            }
        }
        
        $this->data['isViewing'] = false;
        $this->data['videos'] = $videos;
        $this->data['user'] = Auth::user();

        return View::make('video.lists.myvideos', $this->data);
    }

    public function myPlaylist( $playlist_id = ''  ){
        $user = Auth::user();

        $plist = Playlist::find($playlist_id);

        $playlist = VideoPlaylist::where('playlist_id', $playlist_id)->where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        
        
        $this->data['heading'] = $plist->playlist_name;
        $this->data['isViewing'] = false;
        $this->data['playlist'] = $playlist;
        $this->data['user'] = $user;
        
        return View::make('user.playlist', $this->data);
    }

    public function myPlaylistManage(){
        if(Input::get('remove')){
            $playlist_id = Input::get('remove');

            $playlist = VideoPlaylist::find($playlist_id);


            if($playlist->user_id == Auth::user()->id){

                if($playlist->video_id == Input::get('video_id')){

                    $playlist->delete(); // delete a playlist 

                    return Redirect::back()->with('success', 'Successfully removed!');
                }else{

                    return Redirect::back()->with('error', 'Sorry, this video is not from the playlist');
                }
            }else{

                return Redirect::back()->with('error', 'Sorry, this playlist is not yours');
            }
        }

        return Redirect::back()->with('error','Sorry, no action like this.');
    }

    public function updateProfile(){
         if(isset($_POST['edit_user'])){
            $user_id = Auth::user()->id;

            // Set the rules for validation
            $rules = array(
                'firstname' => 'Required',
                'lastname' => 'Required',
                'username' => 'Required',
                'email' => 'Required|Email'
                );

            $inputs = Input::all();

            $validator = Validator::make( $inputs, $rules );

            $validate = $validator->passes();

            // Validate
            if($validate){

                // Get the updated data
                $data = array(
                    'first_name' => Input::get('firstname'),
                    'last_name' => Input::get('lastname'),
                    'username' => Input::get('username'),
                    'email' => Input::get('email'),
                    'updated_at' => date('Y-m-d H:i:s')
                );

                //Save the updated data
                DB::table('users')
                    ->where('id', $user_id)
                    ->update($data);
                
                // Redirect after a successful validation
                return Redirect::back()->with('success', 'Information Successfully Updated!');
            }

            // Redirect if validation failed
            return Redirect::back()->withInputs($inputs)->withErrors($validator->getMessageBag());
        }
    }

    public function updateProfilePicture(){
        $input = Input::all();

        $user = Auth::user();

        $rules = array('image' => 'required|image|mimes:jpeg,png');

        $messages = array();

        $validate = Validator::make($input, $rules, $messages);


        if ($validate->passes()) {

            // Get the image input
            $file = Input::file('image');

            $destinationPath    = public_path('uploads/profilepic/'.$user->id.'/'); // The destination were you store the image.
            $origfilename       = $file->getClientOriginalName(); // Original file name that the end user used for it.
            $mime_type          = $file->getMimeType(); // Gets this example image/png
            $extension          = $file->getClientOriginalExtension(); // The original extension that the user used example .jpg or .png.

            $filename = uniqid() .'_'. $user->first_name.'_'.$user->last_name.'.'.$extension;
            $path = $destinationPath.$filename;

            $upload_success     = $file->move('uploads/profilepic/'.$user->id.'/', $filename); // Now we move the file to its new home.

            /*$s3 = new S3();
            $opt = array(
                'folder' => 'users/'.$user->id.'/profilepic'
            );
            $s3url = $s3->upload( $file->getRealPath(), $filename, $opt );*/

            //unlink($path);

            // This is were you would store the image path in a table
            $userInfo = UserInformation::where('user_id', $user->id)->first();

            if($userInfo){
                $userInfo->picture_key = $filename;
                $userInfo->profile_picture = $path;
                $userInfo->save();
            }else{

                // Create User Information
                $userInfo = new UserInformation();
                $userInfo->user_id = $user->id;
                $userInfo->profile_picture = $s3url;
                $userInfo->save();
            }
            
            return Redirect::back();
        } else {
            return Redirect::back()->withErrors($validate)->withInput();
        }
    }

    public function updateChannelPicture(){
        $input = Input::all();

        $channel_id = Input::get('channel_id');

        $user = Auth::user();

        $rules = array('image' => 'required|image|mimes:jpeg,png');

        $validate = Validator::make($input, $rules);
        
        if ($validate->passes()) {

            // Get the image input
            $file = Input::file('image');

            $destinationPath    = public_path('assets/profilepic/'); // The destination were you store the image.
            $origfilename       = $file->getClientOriginalName(); // Original file name that the end user used for it.
            $mime_type          = $file->getMimeType(); // Gets this example image/png
            $extension          = $file->getClientOriginalExtension(); // The original extension that the user used example .jpg or .png.

            $filename = uniqid() .'_'. $user->first_name.'_'.$user->last_name.'.'.$extension;
            $path = $destinationPath.$filename;

            //$upload_success     = $file->move($destinationPath, $filename); // Now we move the file to its new home.

            $s3 = new S3();
            $opt = array(
                'folder' => 'users/'.$user->id.'/channelpic'
            );
            $s3url = $s3->upload( $file->getRealPath(), $filename, $opt );

            // This is were you would store the image path in a table
            $channel = UserChannel::where('channel_id', $channel_id)->where('user_id', Auth::user()->id)->first();

            if($channel){
                $channel->thumbnail = $s3url;
                $channel->save();
            }else{
                return Redirect::back()->with('error', 'Channel is not found');
            }
            
            return Redirect::back()->with('success', 'Successfully updated!');
        } else {
            return Redirect::back()->withErrors($validate)->withInput();
        }
    }
}