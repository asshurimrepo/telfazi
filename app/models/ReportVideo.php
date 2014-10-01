<?php

class ReportVideo extends Eloquent{
	protected $table = 'report_videos';

	public function report(){
		return $this->hasOne('ReportStatus', 'id', 'report_id');
	}
}