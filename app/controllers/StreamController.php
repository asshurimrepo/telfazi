<?php

class StreamController extends BaseController{
	protected $whitelist = array(
        'showStreamVideos', 'streamReader'
    );
	
    protected  $imgTypes = array('jpeg', 'jpg', 'png', 'gif'); // The extensions of Images that the plugin will read

	public function showStreamVideos( $id = '' ){
		if( empty($id) ){
			return View::make('stream', $this->data);
		}else{
			$videos = new Video();
			$videos->withNoStatus(true);

			$video = $videos->where('videos.id', $id)->first();
			$streams = $videos->stream()->where('videos.id', '!=', $video->id)->get();

			$this->data['streams'] = $streams;
			$this->data['video'] = 	$video;

			return View::make('streamwatch', $this->data);
		}
	}


	//Get pictures from database
	public function streamReader(){
		$cats = StreamCategory::all(); $categories = array();
		$output = array();
		//$output['All'] = $this->compileData(Video::withNotPublished()->stream()->get());
        $output['All'] = array();
		foreach($cats as $c){
			if( empty($c->parent_slug) ){
				
				if(count($c->videos()) > 0){
					$output[$c->title] = $this->compileData( $c->videos() );
				}
			}	
		}
		echo json_encode($output);
	}

	public function compileData($videos){
		$d = array();
		foreach ($videos as $key => $video) {
			$d[$video->thumbnail_url] = array(
				'title' => $video->sub_name,
				'url' => $video->gotoUrl(),
				'thumbnail' => $video->thumbnail_url,
				'thumb' => 'no',
				'order' => ''
			);
		}

		return $d;
	}

	//Get Pictures from Directory
	/*public function streamReader(){
		
		$categoriesOrder    = $_GET['categoriesOrder']; //byDate, byDateReverse, byName, byNameReverse, random
		$imagesOrder      = $_GET['imagesOrder']; //byDate, byDateReverse, byName, byNameReverse, random
	
		$directory = $_GET['directory'];



		//THE RESULT OF THE JSON CALL
		$output = array();

		//GET THE CATEGORIES
		$folders = $this->getFoldersList($directory);

		//GET THE IMAGES IN ROOT
		$imagesInRoot = $this->getImagesList($directory);

		//ADD THE IMAGES IN ROOT
		$output['All'] = $this->fixArray($imagesInRoot, $directory);

		//GET THE IMAGES OF EACH CATEGORY
		foreach ($folders as $key => $value) {
		  
			$images = $this->getImagesList($directory."/".$value);

			//ADD THE IMAGES OF EACH CATEGORY
			$output[$value] = $this->fixArray($images, $directory.'/'.$value);
		}

		//print_r($output);

		//echo json_encode($output, JSON_FORCE_OBJECT); // if you are using PHP 5.3 plase use this line instead of the one below

		echo json_encode($output); 
	}*/


	private function getFoldersList ($directory){
	    global $categoriesOrder;
	    if( !is_dir($directory)){//If the parameter is a directory if not then just return
	      return array();
	    }
	    $results = array();
	    $handler = opendir($directory);
	    while ($file = readdir($handler)) {
	      if ($file != "." && $file != ".." && $file != ".DS_Store" && is_dir($directory.'/'.$file) && $file != "thumbnails" ) {//If it is a folder
	        $ctime = filemtime($directory .'/'. $file) . ',' . $file; //BRING THE DATE OF THE FOLDER
	        if($categoriesOrder == 'byName' || $categoriesOrder == 'byNameReverse'){
	            $ctime = $file;
	        }
	        $results[strtolower($ctime)] = $file;
	      }
	    }

	    closedir($handler);
	    if($categoriesOrder == 'byDate' || $categoriesOrder == 'byNameReverse'){
	        krsort($results);
	    }else if($categoriesOrder == 'byDateReverse' || $categoriesOrder == 'byName'){
	        ksort($results);
	    }else if($categoriesOrder == 'random'){
	        shuffle($results);
	    }
	    
	    return $results;
	}

	private function getImagesList ($directory) {
		global $imgTypes;
		global $imagesOrder;

		if( !is_dir($directory)){
		return array();
		}

		$results = array();

		$handler = opendir($directory);

		while ($file = readdir($handler)) {
		if ($file != "." && $file != ".." && $file != ".DS_Store") {
		 $extension = preg_split('/\./',$file);
		 $extension = strtolower($extension[count($extension)-1]);
		 
		 if(array_search($extension,$this->imgTypes) !== FALSE){
		    $ctime = filemtime($directory .'/'. $file) . ',' . $file; //BRING THE DATE OF THE IMAGE
		    if($imagesOrder == 'byName' || $imagesOrder == 'byNameReverse'){
		        $ctime = $file;
		    }
		    $results[strtolower($ctime)] = $file;
		 }   
		    
		}
		}

		closedir($handler);
		if($imagesOrder == 'byDate' || $imagesOrder == 'byNameReverse'){
		krsort($results);
		}else if($imagesOrder == 'byDateReverse' || $imagesOrder == 'byName'){
		ksort($results);
		}else if($imagesOrder == 'random'){
		shuffle($results);
		}
		return $results;
	}

	private function fixArray($list, $directory){

		$return = array();

		foreach ($list as $key => $value) {

		    $thumb = 'no';
		    if( file_exists( $directory.'/thumbnails'.'/'.$value ) ){//VERIFY IF THERE IS ANY THUMBNAIL FOR THE IMAGE
		      $thumb = 'yes';
		    }            
		    //CUSTOMIZATION-->
		    $values = array();
		    $values["thumb"] = $thumb;
		    $values["order"] = $key;

		    $return[$value] = $values;
		}

		return $return;
	}


	/*public function showStreamVideos( $id = '' ){

		if( empty($id) )
			$stream = LiveStream::orderby('created_at', 'desc')->take(1)->first();
		else
			$stream  = LiveStream::find( $id );		

		$video = Video::withNotPublished()->where('videos.id', $stream->video_id)->first();

		$video->title = $stream->name;
		$video->description = $stream->description;		

		$this->data['stream'] = $stream;
		$this->data['video'] = 	$video;
	
		return View::make('stream', $this->data);
	}*/
}