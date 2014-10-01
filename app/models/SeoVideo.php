<?php

class SeoVideo extends \Eloquent {
	protected $table = 'seo_video_url';
    protected $guarded = ['id'];

    public static function hasSeoUrl( $video_slug ){
        $seo = SeoVideo::where( 'url', $video_slug )->first();
        if( $seo ){
            return true;
        }else{
            return false;
        }
    }

    public static function getVideoBySlug( $video_slug ){
        $seo = SeoVideo::where( 'url', $video_slug )->first();
        if( $seo ){
            return Video::find($seo->video_id);
        }

        return array();
    }
}