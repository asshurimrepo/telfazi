<?php

class BaseController extends Controller {


	// Let's whitelist all the methods we want to allow guests to visit!
	protected $whitelist = array(
		'pageNotFound'
	);

	protected $user;

	protected $userID; // Get the logged user ID

	protected $channelID; // Get the first channel ID of a User

	protected $role; // Get the role of the user

	protected $data;

	protected $lang_id = 2; // language default id, english.

	protected $catIcons = array(
							  'fa fa-car',
							  'glyphicon glyphicon-heart',
							  'glyphicon glyphicon-cutlery',
							  'fa fa-smile-o',
							  'icon icon-soccer',
							  'fa fa-flag-checkered',
							  'glyphicon glyphicon-plane',
							  'fa fa-book',
							  'fa fa-mobile'
  							);

    public function __construct()
	{



		$this->beforeFilter('auth', array('except' =>  $this->whitelist ));


		$this->data['style'] = 'style.css'; 
		App::setLocale('en'); //default language in english


		if(Input::has('lang')){

			Session::set('lang', Input::get('lang') );

		}


		if(Session::has('lang')){
			$langs = array('en', 'ar');

			if( in_array( Session::get('lang'), $langs) ){

				App::setLocale( Session::get('lang') );

				if(Session::get('lang') == 'ar'){
					$this->lang_id = 1; 
					$this->data['style'] = 'arabic.css';
				}
			}
		}

		Session::set('lang_id', $this->lang_id);

		$this->init(); // Run all initializations.

		$this->sitePageTitle(); // page titles

    }

    private function init(){
		if(Auth::check()){
			$this->userID = Auth::user()->id;
			//$this->channelID = VideoObject::getUserFirstChannel($this->userID)->channel_id;
		}

		//animations
		$this->data['trans_dura'] = 200;


		$this->data['twitter_url'] = 'https://twitter.com/Telfazi';
		$this->data['facebook_url'] = 'https://www.facebook.com/telfazi';
		$this->data['catIcons'] = $this->catIcons;
		$this->data['menuList'] = $this->getMenuList();
		$this->data['menuSegments'] = $this->menuTitleSegment();
		$this->data['siteTitle'] = 'Telfazi';
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}


	private function getMenuList(){
		$menuList = array();

		if(Auth::check()){

			$data = array(
				Lang::get('lang.browse_videos') => route('browse_videos_page'),
				Lang::get('lang.channels') => URL::to('channels'), 
				'MyTV' =>  URL::to('mytv'), 
				Lang::get('lang.home')  => URL::to('/')
			);
		}else{
			$data = array(
				Lang::get('lang.browse_videos') => route('browse_videos_page'),
				Lang::get('lang.channels') => URL::to('channels'), 
				Lang::get('lang.home')  => URL::to('/')
			);
		}

		$menuList = $data;

		return $menuList;
	}

	private function menuTitleSegment(){

		$data = array(
			Lang::get('lang.browse_videos') => array('browsevids'),
			Lang::get('lang.channels') => array('channels'),
			'MyTV' => array('mytv'),
			Lang::get('lang.home') => array('', 'watch', 'user')
		);
		

		
		return $data;
	}

	private function sitePageTitle(){
		$segment = Request::segment(1);

		$titles = array(
			Lang::get('lang.home') => array(''),
			'MyTV' => array('mytv'),
			Lang::get('lang.channels')  => array('channels'),
			Lang::get('lang.browse_videos')  => array('browsevids'),
			'Search Result' => array('search'),
			'Upload Video' => array('upload')
		);

		$t = '';
		foreach($titles as $title => $segments){
			if( in_array($segment, $segments) ){

				$t = $title; 
			}
		}
		
		$this->data['pageTitle'] = $t;
	}

	public function pageNotFound(){
		$this->data['siteTitle'] = 'Page Not Found';
		return View::make('errors.notfound', $this->data);
	}
}