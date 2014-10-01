<?php
use iboostme\Video\VideoAdapter;

/**
 * Class VideoUploadController
 */
class VideoUploadController extends \BaseController {

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {

        $channelID = Auth::user()->userChannels->first()->channel_id;
        return Redirect::to('upload/' . $channelID);

    }


    /**
     * @param $channelID
     * @return \Illuminate\View\View
     */
    public function index($channelID)
    {
        $user = Auth::user();
        $v = new VideoAdapter(['folder' => $channelID . '/']);

        //get the recent uploaded videos
        $videos = RecentVideo::getRecentUploads($user->id, $channelID);

        $params = [
            'videos'    => $videos,
            'user'      => $user,
            'channelID' => $channelID,
            'isViewing' => false
        ];

        $this->data = array_merge($this->data, $v->getConfig($params));

        return View::make('video.upload', $this->data);
    }

    /**
     * @param $channelID
     * @return string
     */
    public function saveVideo($channelID)
    {
        if (Input::has('fileData'))
        {

            set_time_limit(0);

            $name = Input::get('name');
            $size = Input::get('size');
            $type = Input::get('type');
            $bucket = Input::get('bucket');
            $url = urldecode(Input::get('url'));
            $key = Input::get('key');
            $get_name = explode('.', $name);

            $videoUrl = $url;
            $thumbname = $get_name[0];

            //new VideoObject
            $videoObject = new VideoObject();
            $names = $videoObject->generateThumbnails($videoUrl, $thumbname);

//            return $names;

            foreach ($names as $n)
            {
                $opt['folder'] = $channelID;

                $path = public_path('uploads/videothumbs/' . $n);

                $s3url = $videoObject->uploadtoS3($path, $n, $opt);

                if (file_exists($path))
                {
                    unlink($path);
                }
            }

            // Save a new Video
            $video_url = Setting::where('key', 's3_live')->first()->value . $key;
            $data = array(
                'title'         => $get_name[0],
                'video_url'     => $key,
                'published'     => 0,
                'thumbnail_url' => $s3url,
                'duration'      => $this->ffmpeg_video_duration_string($video_url),
                'creation_date' => date('Y-m-d'),
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            );

            $video_id = DB::table('videos')->insertGetId($data);

            if (count($names) > 0)
            {
                foreach ($names as $n)
                {

                    // Save new thumbnails
                    $vidthumbs = new VideoThumbnail();
                    $vidthumbs->video_id = $video_id;
                    $vidthumbs->thumbnail = 'thumbnails/' . $n;
                    $vidthumbs->save();
                }
            }

            // Save a new Channel
            $channel = new Channel();
            $channel->channel_id = UserChannel::where('channel_id', $channelID)->first()->id;
            $channel->video_id = $video_id;
            $channel->save();

            // Add new feed
            $feed = new ActivityFeed();
            $feed->type_id = ActivityType::where('type_name', 'Video')->first()->id;
            $feed->user_id = Auth::user()->id;
            $feed->activity_id = $video_id;
            $feed->save();

            // Add video to recent
            $recent = new RecentVideo();
            $recent->user_id = Auth::user()->id;
            $recent->channel_id = $channelID;
            $recent->video_id = $video_id;
            $recent->save();

        } else
        {
            return 'file data is not found';
        }
    }

    /**
     *
     */
    public function s3upload_callback()
    {
        $bucket = html_entity_decode($_GET['bucket']);
        $key = html_entity_decode($_GET['key']);
        $etag = str_replace('"', '', html_entity_decode($_GET['etag']));
        $callbackUrl = 'http://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

        // Echo a JSON string into the YUI generated IFRAME so that the client browser is aware of the upload

        echo '{"bucket": "' . $bucket . '", "key": "' . $key . '", "etag": "' . $etag . '", "callbackUrl": "' . $callbackUrl . '"}';
    }

    /**
     * @return \Illuminate\View\View
     */
    public function postRecentVideos()
    {
        $user = Auth::user();

        //get the recent uploaded videos
        $videos = RecentVideo::getRecentUploads($user->id);

        $this->data['user'] = $user;
        $this->data['videos'] = $videos;

        return View::make('video.lists.newuploads', $this->data);
    }

    /*private function ffmpeg_create_thumbs( $url, $opt ){
        $ffmpeg = 'ffmpeg';
        $file 	= $url;
        $thumb 	= public_path( $opt['thumbpath'] . $opt['thumbname'] );

        $command = "$ffmpeg -i $file -ss 00:00:5 -s 250x167 -vframes 1 $thumb";

        shell_exec($command);
    }

    private function ffmpeg_video_duration( $url ){
        $result = shell_exec(" ffmpeg -i ".$url." 2>&1 | grep Duration: | cut -f2- -d: | cut -f1 -d, | tr -d ' ' ");
        $duration = explode(":",$result);

        if( $result[0] != '' ){
            $duration_in_seconds = $duration[0]*3600 + $duration[1]*60+ round($duration[2]);

            return $duration_in_seconds;
        }

        return 0;
    }*/

    /**
     * @param $url
     * @return string
     */
    private function ffmpeg_video_duration_string($url)
    {
        $result = shell_exec(" ffmpeg -i " . $url . " 2>&1 | grep Duration: | cut -f2- -d: | cut -f1 -d, | tr -d ' ' ");

        if ( ! empty($result))
        {
            return $result;
        } else
        {
            return '';
        }
    }

}