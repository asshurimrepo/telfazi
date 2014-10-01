<?php
use Aws\S3\S3Client;

class Util{

    public function Util(){


    }

    /**
     * Display arrays and objects properly.
     *
     * @return arrays and objects.
     */
    public static function trace($ar, $color = "F00"){
        //display objects, array, strings properly.

        echo '<pre style="z-index:9999;color:#'.$color.'">';
        print_r($ar);
        echo '</pre><br style="clear:both;" /><br />';
    }

    /**
     * Limit the words or strings to display.
     *
     * @return the limited words or strings.
     */
    public static function limit_words($string, $limit){
    	//

        if(!is_string( $string )){
    		die($string . ' is not a string');
    	}
    	if(! is_numeric( $limit )){
    		die($string . ' is not a number');	
    	}

    	$words = explode(' ', $string);

    	$limited_words = implode(' ', array_splice($words, 0, $limit));
    	
    	return $limited_words;
    }

    public static function split_words($string, $nb_caracs, $separator){
        $string = strip_tags(html_entity_decode($string));
        if( strlen($string) <= $nb_caracs ){
            $final_string = $string;
        } else {
            $final_string = "";
            $words = explode(" ", $string);
            foreach( $words as $value ){
                if( strlen($final_string . " " . $value) < $nb_caracs ){
                    if( !empty($final_string) ) $final_string .= " ";
                    $final_string .= $value;
                } else {
                    break;
                }
            }
            $final_string .= $separator;
        }
        return $final_string;
    }

    /**
     * Encrypt urls or other sensitive data.
     */
    public static function url_encrpyt( $url_string ){
        // Encode the url.
        return base64_encode($url_string);
    }


    /**
     * Decrypt urls or other sensitive data.
     */
    public static function url_decrpyt( $url_string ){
        // Decode the url.
        return base64_decode( $url_string );
    }

    /**
     * Match the first word to the second word.
     */
    public static function match_words($first, $second){

        if( strlen($first) == strlen($second) ){
            $str1 = str_split($first);
            $str2 = str_split($second);
    
            for ($i=0; $i < strlen($first); $i++) { 
                if($str1[$i] != $str2[$i]){
                    return false;
                }
            }
        }else{
            return false;
        }

        return true;
    }

    // remove the slashes of the string. Usually used for JSON string.
    public static function noSlash($jsonString, $isForce = false ){
        if( $isForce ){
            return stripslashes( $jsonString );
        }else{
            return get_magic_quotes_gpc() ? stripslashes( $jsonString ) : $jsonString;
        }
    }

    public static function getExtension($str) 
    {
             $i = strrpos($str,".");
             if (!$i) { return ""; } 

             $l = strlen($str) - $i;
             $ext = substr($str,$i+1,$l);
             return $ext;
    }


    // Removes all the the single and double quotes. 
    public static function string_sanitize($s) {
        $result = preg_replace("/[^a-zA-Z0-9]+/", "", html_entity_decode($s, ENT_QUOTES));
        return $result;
    }

    public static function arrayWalk($array, $append, $type = 'front', $as = ''){
        $ar = array();
        if(count($array)>0){
            foreach($array as $k=>$v){
                switch($type){
                    case 'back':
                        $ar[$k] = $v . $append;
                        break;
                    case 'as':
                        $ar[$k] = $append . $v . ' as ' . $as . $v;
                        break;
                    default:
                        $ar[$k] = $append . $v;
                }
            }
        }

        return $ar;
    }

    public static function getDuration( $result ){

        if( empty($result)){
            return '00:00';
        }else{
            $duration = explode(":",$result);

            $duration_in_seconds = $duration[0]*3600 + $duration[1]*60+ round($duration[2]);

            return gmdate("i:s", $duration_in_seconds);
        }
    }

    //This function will create an SEO friendly string
    public static function seoUrl($string) {
        //Lower case everything
        $string = strtolower($string);
        //Make alphanumeric (removes all other characters)
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        //Clean up multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);
        //Convert whitespaces and underscore to dash
        $string = preg_replace("/[\s_]/", "-", $string);
        return $string;
    }


    //http://stackoverflow.com/questions/2510434/format-bytes-to-kilobytes-megabytes-gigabytes
    public static function formatBytes($size, $precision = 2)
    {
        $base = log($size) / log(1024);
        $suffixes = array('', 'k', 'M', 'G', 'T');   

        return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
    }

    public static function checkS3Thumbnail( $url ){
        $accessKey = Setting::where('key', 'access_key')->first()->value;
        $secretKey = Setting::where('key', 'secret_key')->first()->value;
        $bucket    = Setting::where('key', 'bucket')->first()->value;
        $client = S3Client::factory(array(
            'key'    => $accessKey,
            'secret' => $secretKey,
            'region' => Aws\Common\Enum\Region::US_WEST_2
        ));
        
        $objkey = str_replace('https://s3-us-west-2.amazonaws.com/vidorabia.test/', '', $url);
        
        if($client->doesObjectExist($bucket, $objkey) == false ){
            return false;
        }

        return true;
    }
}
