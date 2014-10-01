<?php

class VideoDetailController extends BaseController{


	public function videoDetail($id){
		$video = Video::find($id);

		$categories = Category::all();

		$this->data['categories'] = $categories;
		$this->data['video'] = $video;

		return View::make('video.detail.detail', $this->data);
	}

	public function videoDetailSave(){
		$video_id = Input::get('video_id');
		$category_id = Input::get('category');
		$tags = Input::get('tags');

		$video = new Video();
		$video->withNoStatus(true);
		$video = $video->where('id', $video_id)->first();
		if(empty($video)){
			return Redirect::back()->with('error', 'Video does not exists.');
		}
		if(count($tags) > 0){
			foreach($tags as $t){
				$tag = Tag::where('name', $t)->first();
				if( empty($tag)){
					return Redirect::back()->with('error', 'Provide tags that are available in the suggestion.');
				}
			}
		}

		//save video
		DB::table('videos')->where('id', $video->id)->update([
			'title' => Input::get('title'),
			'description' => Input::get('description'),
			'published' => 1,
			'status' => 2,
			'seo_url' =>  Util::seoUrl( Input::get('title') ),
		]);

		if($category_id){
			$vCat = VideoCategory::where('video_id', $video_id)->first();
			if($vCat){
				$vCat->category_id = $category_id;
				$vCat->video_id = $video->id;
				$vCat->save();
			}else{
				$vCat = new VideoCategory();
				$vCat->category_id = $category_id;
				$vCat->video_id = $video->id;
				$vCat->save();
			}
		}

		if(count($tags) > 0){
			foreach($tags as $t){
				$tag = Tag::where('name', $t)->first();

				if($tag){
					$vtag = new VideoTag();
					$vtag->tag_id = $tag->id;
					$vtag->video_id = $video->id;
					$vtag->save();
				}else{
					return Redirect::back()->with('error', 'Provide tags that are available in the suggestion.');
				}
			}
		}

		// remove video from recents
		$recent = RecentVideo::where('video_id', $video_id)->first();
		if($recent){
			$recent->delete();
		}
		return Redirect::back()->with('success', 'Video successfully published!');
	}

	public function videoTranslate($id){
		if(Auth::user()->isAdmin() == false)
			return Response::view('errors.notfound', $this->data, 404);



		$video = Video::with('translations.language')->find($id);
		
		$this->data['lang_to_add'] = array_except(Language::lists('language','id'), $video->translations->lists('language_id'));
		$this->data['video'] = $video;
		$this->data['user'] = Auth::user();

		return View::make('user.translate', $this->data);
	}

	public function videoTranslatePost(){
		$validate = VideoTranslate::validate( Input::all() );

		if($validate->passes()){

			$translate = VideoTranslate::create(Input::except('submit'));

			return Redirect::back()->with('success', 'Successfully translated');
		}
		else{
			return Redirect::back()->with('error', 'Do not leave fields empty')->withInput();
		}

		return Util::trace( Input::all() );
	}

	public function videoTranslateDelete($id)
	{
		VideoTranslate::find($id)->delete();
		return Redirect::back()->with('success', 'Translation Successfully Removed.');

	}

	public function videoManage(){

		if(Input::get('delete')){
			$video_id = Input::get('delete');

			$video = Video::where('id', $video_id)->first();
			$video->delete();

			return Redirect::back()->with('success', 'Video successfully deleted');
		}

		if(Input::get('restore')){
			$video_id = Input::get('restore');

			$video = Video::withTrashed()->where('id', $video_id)->first();

			$video->restore();

			return Redirect::back()->with('success', 'Video successfully restored');
		}

		if(Input::get('edit')){
			$video_id = Input::get('edit');

			return Redirect::to('video/edit/'.$video_id);
		}

		if(Input::get('translate')){
			$video_id = Input::get('translate');

			return Redirect::to('video/translate/'.$video_id);
		}
	}

	
}