<?php

class ChannelController extends BaseController{
	// List of actions that are not allowed for the guess.
    protected $whitelist = array(
        'channels', 'viewChannel'
    );

    public function channels($filter = 'all', $cat_id = null){


    	// Filtered By Category
		if($filter == 'category' && $cat_id){
			$cat = Category::find($cat_id);

			$channels = $cat->channels();

			$this->data['filter'] = $cat->title;
		}else{

			// all channels
			$channels = UserChannel::all();    			

			$this->data['filter'] = 'All Channels';
		}

    	$this->data['channels'] = $channels;

    	return View::make('channel.channels', $this->data);
    }

	public function viewChannel($channel_id){
		$channel = UserChannel::find($channel_id);

		if(empty($channel)){
			return Redirect::to('channels')->with('error', 'Channel not found');
		}

		$videos = $channel->videos()
			->byLanguage($this->lang_id)
			->take(20)
			->get();

		//get the channel
		$userChannel = UserChannel::where('id', $channel_id)->first();

		$this->data['channel'] = $userChannel;
		$this->data['videos'] = $videos;
		
		return View::make('channel.channel', $this->data);
	}



	public function subscribe(){
		$channel_id = Request::segment(2);

		$user = Auth::user();

		//$subscribe = ChannelSubscribe::where('user_id', $user->id)->where('channel_id', $channel_id)->first();

		$subscribe = UserChannel::where('channel_id', $channel_id)->first();

		$this->data['c'] = $subscribe;
		
		$this->data['subscribed'] = $subscribe->subscribe;
		
		return View::make('channel.lists.subscribe', $this->data);
	}

	public function subscribeTo(){

		$subscribeTo = Input::get('subscribeTo');
		$user = Auth::user();

		$sub = ChannelSubscribe::where('user_id', $user->id)->where('channel_id', $subscribeTo)->first();
		
		

		if($sub){
			$sub->subscribed = !$sub->subscribed;
			$sub->unsubscribed = !$sub->subscribed;
			$sub->save();

			if($sub->subscribed){

				// Add new feed
				$feed = new ActivityFeed();
				$feed->type_id = ActivityType::where('type_name', 'Subscribe')->first()->id;
				$feed->user_id = Auth::user()->id;
				$feed->activity_id = $sub->id;
				$feed->save();
			}

		}
		else{
			$sub = new ChannelSubscribe();
			$sub->user_id = $user->id;
			$sub->channel_id = $subscribeTo;
			$sub->subscribed = 1;
			$sub->save();
		}

		// Add new feed
		$feed = new ActivityFeed();
		$feed->type_id = ActivityType::where('type_name', 'Subscribe')->first()->id;
		$feed->user_id = Auth::user()->id;
		$feed->activity_id = $sub->id;
		$feed->content = json_encode( array('subscribed'=> $sub->subscribed) );
		$feed->save();
		

		return Response::json(array('subscribeTo'=>$subscribeTo ));
	}



    
}