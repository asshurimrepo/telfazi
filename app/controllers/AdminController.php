<?php

class AdminController extends BaseController{
	public function allVideos(){
		$user = Auth::user();
		if($user->isAdmin() == false)
			return Response::view('errors.notfound', $this->data, 404);

		$take = 20;
        
        $videos = Video::take( $take )->withTrashed()->get();

        $this->data['urlback'] = 'allvids';
		$this->data['take'] = $take;
        $this->data['isViewing'] = false;
        $this->data['videos'] = $videos;
        $this->data['user'] = Auth::user();

		return View::make('user.myvideos', $this->data);
	}

	public function allVideosPost(){
		$user = Auth::user();
		if($user->isAdmin() == false)
			return Response::view('errors.notfound', $this->data, 404);
		
		$page = Input::get('getLastPage');
		$take = 20;
        $offset = $page * $take - $take;
        
        $videos = Video::offset( $offset )->take( $take )->withTrashed()->get();

        $this->data['urlback'] = 'allvids';
		$this->data['take'] = $take;
        $this->data['isViewing'] = false;
        $this->data['videos'] = $videos;
        $this->data['user'] = Auth::user();

		return View::make('video.lists.myvideos', $this->data);
	}
}
