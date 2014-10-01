<?php
use Aws\S3\Model\MultipartUpload\UploadBuilder;
use Aws\S3\S3Client;


class VideoObject {

	public static $temp_thumbnail_location = 'assets/vidthumbs/';

	private $awsAccessKeyId;

	private $awsSecretAccessKey;

	private $bucket;

	private $s3_url = 'https://s3-us-west-2.amazonaws.com/vidorabia';

	public function __construct(){
		$this->awsAccessKeyId 		= Setting::where('key', 'access_key')->first()->value;
		$this->awsSecretAccessKey 	= Setting::where('key', 'secret_key')->first()->value;
		$this->bucket 				= Setting::where('key', 'bucket')->first()->value;
	}

	private static function initAWS(){
	
		
	} 

	public function generateThumbnails( $videoUrl, $thumbName ){
		$seconds = 5;
		$total = 1;
		$names = array(); 

		for($i = 0; $i < $total; $i++){
			$name = time() . '-' . Util::seoUrl($thumbName) . '.jpg';

			$names[] = $name;

			$interval = floor(rand(2, $seconds - 2));

			$options = array(
				'videofile' => $videoUrl,
				'thumbpath' => 'uploads/videothumbs/',
				'thumbname' => $name,
				'interval' 	=> $interval,
				'size' 		=> '250x167'
				);

			$this->ffmpeg_create_thumbs( $videoUrl, $options );
		}

		return $names;
	}

	public function uploadtoS3( $path, $new_name, $opt = array() ){
		$this->client = S3Client::factory(array(
		    'key'    => $this->awsAccessKeyId ,
            'secret' => $this->awsSecretAccessKey,
            'region' => Aws\Common\Enum\Region::US_WEST_2
		));


		$uploader = UploadBuilder::newInstance()
			->setClient( $this->client )
			->setSource( $path )
			->setBucket( $this->bucket )
			->setKey( $opt['folder'] .'/thumbnails/'. $new_name )
			->setOption('CacheControl', 'max-age=3600')
			->setOption('ACL', 'public-read')
			->build();

		$uploader->upload();

		try {
			$uploader->upload();
		} catch (MultipartUploadException $e) {
			$uploader->abort();
		}  

		return  /*$this->s3_url.'/'.*/$opt['folder'].'/thumbnails/'.$new_name; 
	}

	private function ffmpeg_create_thumbs( $url, $opt ){
		$ffmpeg = 'ffmpeg';
		$file 	= $url;
		$interval = $opt['interval'];
		$size = $opt['size'];
		$thumb 	= public_path( $opt['thumbpath'] . $opt['thumbname'] );

		$command = "$ffmpeg -i $file -ss 00:00:$interval -s $size -vframes 1 $thumb";

		exec($command);
	}
}