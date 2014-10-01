<?php
use Aws\S3\S3Client;
use app\LangHelper;

class TestController extends BaseController{
	protected $whitelist = array('test', 'seoUrlGenerate', 'videoThumbGenerate');

	public function test(){
        $t = '%D8%AF%D9%88%D8%B1%D9%8A-%D8%B9%D8%A8%D8%AF-%D8%A7%D9%84%D9%84%D8%B7%D9%8A%D9%81-%D8%AC%D9%85%D9%8A%D9%84-%D8%A7%D9%84%D8%B3%D8%B9%D9%88%D8%AF%D9%8A-%D9%84%D9%84%D9%85%D8%AD%D8%AA%D8%B1%D9%81%D9%8A%D9%86---%D9%87%D8%AF%D9%81-%D8%A7%D9%84%D8%A5%D8%AA%D8%AD%D8%A7%D8%AF-%D8%A7%D9%84%D8%A3%D9%88%D9%84-%22%D9%85%D8%A7%D8%B1%D9%83%D9%8A%D9%86%D9%8A%D9%88%22-%D9%81%D9%8A-%D9%85%D8%B1%D9%85%D9%89-%D8%A7%D9%84%D8%B4%D8%B9%D9%84%D8%A9-%D8%A7%D9%84%D8%A3%D8%B3%D8%A8%D9%88%D8%B9-%D8%A7%D9%84%D8%AB%D8%A7%D9%';

    }

    //generate seo url from videos with english language.
    public function seoUrlGenerate(){
        $videos = Video::byLanguage(2)->get();
        foreach($videos as $v){
            $v->seo_url = trim(Util::seoUrl( $v->getTitle() ), '-');
            $v->save();
        }
    }
}
