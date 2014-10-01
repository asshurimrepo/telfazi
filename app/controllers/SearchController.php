<?php

class SearchController extends BaseController {

	protected $whitelist = array('index', 'searchQuery');

	public function searchQuery(){
		$query = e(Input::get('q'));

		if(!$query && $query == '') return Response::view('errors.notfound', $this->data, 400);
		
		$videos = Video::byLanguage($this->lang_id)
		->where('videos.title', 'like', '%'.$query.'%')
		->where('videos.description', 'like', '%'.$query.'%')
		->orderBy('videos.created_at', 'desc')
		->get();

		$this->data['type'] = 'search';

		$this->data['videos'] = $videos;
		
		return View::make('video.searchresult',$this->data);
	}

	public function searchMyVideos( ){
		$query = e(Input::get('q'));

		$user = Auth::user();

		if(!$query && $query == '') return Response::view('errors.notfound', $this->data, 400);
		

		//TODO:: search videos base on user channel
		$videos = Video::byLanguage($this->lang_id)
		->where('videos.title', 'like', '%'.$query.'%')
		->where('videos.description', 'like', '%'.$query.'%')
		->orderBy('videos.created_at', 'desc')
		->get();		

		$this->data['videos'] = array();
		if($videos->count() > 0){

			foreach($videos as $v){

				if($v->user()){
					if( $v->user()->id == $user->id  ){
						$this->data['videos'][] = $v;
					}
				}
			}

		}
		
		$this->data['user'] = $user;
		return View::make('video.lists.myvideos',$this->data);
	}
}

