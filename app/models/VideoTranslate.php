<?php 

class VideoTranslate extends Eloquent{
	protected $table = 'video_translations';


	protected $guarded = array('id');

	public static function validate($input, $rules = array()){
		if( empty($rules) ){
			$rules = array(
		        'video_id' => 'Required',
		        'language_id'     => 'Required',
		        'title' => 'Required',
		        'description' => 'Required'
			);
		}		 

		return Validator::make($input, $rules);
	}

	public function language()
	{
		return $this->belongsTo('Language');
	}

	public function video(){
		return $this->hasOne('Video', 'id', 'video_id');
	}
}