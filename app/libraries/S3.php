<?php
use Aws\S3\Model\MultipartUpload\UploadBuilder;
use Aws\S3\S3Client;

class S3{
	public static $temp_thumbnail_location = 'assets/vidthumbs/';

	private $awsAccessKeyId;

	private $awsSecretAccessKey;

	private $bucket;

	private $s3_url = 'https://s3-us-west-2.amazonaws.com/vidorabia.test';
	


	public function __construct(){
		$this->awsAccessKeyId 		= Setting::where('key', 'access_key')->first()->value;
		$this->awsSecretAccessKey 	= Setting::where('key', 'secret_key')->first()->value;
		$this->bucket 				= Setting::where('key', 'bucket')->first()->value;
	}

	public function upload( $path, $new_name, $opt = array() ){
		$this->client = S3Client::factory(array(
		    'key'    => $this->awsAccessKeyId ,
            'secret' => $this->awsSecretAccessKey,
            'region' => Aws\Common\Enum\Region::US_WEST_2
		));

		$key = $opt['folder'] .'/'. $new_name;

		$uploader = UploadBuilder::newInstance()
			->setClient( $this->client )
			->setSource( $path )
			->setBucket( $this->bucket )
			->setKey( $key  )
			->setOption('CacheControl', 'max-age=3600')
			->setOption('ACL', 'public-read')
			->build();

		$uploader->upload();

		try {
			$uploader->upload();
		} catch (MultipartUploadException $e) {
			$uploader->abort();
		}  

		return  $this->s3_url.'/'.$key; 
	}
}