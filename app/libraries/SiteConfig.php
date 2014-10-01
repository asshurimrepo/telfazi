<?php

class SiteConfig {

	public static function getAccessKey(){
		return Setting::where('key', 'access_key')->first()->value;
	}

	public static function getSecretKey(){
		return Setting::where('key', 'secret_key')->first()->value;
	}

	public static function bucket(){
		return Setting::where('key', 'bucket')->first()->value;
	}

	public static function s3url(){
		return 'https://s3-us-west-2.amazonaws.com/vidorabia.test/';
	}

}