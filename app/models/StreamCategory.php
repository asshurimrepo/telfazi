<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class StreamCategory extends Eloquent{
	use SoftDeletingTrait;

	protected $table = 'streamcategories';

	protected $softDelete = true;
	
	public function videos(){
		$data = array();
		$sc = StreamerCategory::where('category_id', $this->id)->get();
		foreach($sc as $c){
			$video = new Video();
			$video->withNoStatus(true);
			$video = $video->stream()->where('id',$c->video_id)->first();
			if($video){
				$data[] = $video;
			}
		}

		return $data;
	}	
}

