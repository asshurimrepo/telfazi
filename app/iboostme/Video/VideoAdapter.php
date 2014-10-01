<?php  namespace iboostme\Video;

use Illuminate\Support\Facades\Config;
use S3PolicySignature;

class VideoAdapter {


    protected $awsAccessKeyId;
    protected $awsSecretAccessKey;
    protected $bucket;
    protected $folder;

    public function __construct($params = [])
    {
        $this->getS3PolicySignature();
        $this->setConfig();
        $this->registerCustomParams($params);
    }

    /**
     * @param array $params
     * @return array
     */
    public function getConfig($params = [])
    {
        $this->registerCustomParams($params);
        return $this->toArray();
    }

    /**
     * @internal param $bucket
     * @internal param $folder
     */

    protected function getS3PolicySignature()
    {
        list($this->policy, $this->signature) = S3PolicySignature::get_policy_and_signature(array(
            'bucket' => $this->bucket,
            'folder' => $this->folder
        ));

    }

    /**
     * @internal param $awsAccessKeyId
     * @internal param $awsSecretAccessKey
     * @internal param $bucket
     */
    protected function setConfig()
    {
        $this->awsAccessKeyId = Config::get('services.as3.access_key');
        $this->awsSecretAccessKey = Config::get('services.as3.secret_key');
        $this->bucket = Config::get('services.as3.bucket');
    }

    /**
     * @return array
     */
    private function toArray()
    {
        return get_object_vars($this);
    }

    /**
     * @param $params
     */
    protected function registerCustomParams($params)
    {
        foreach ($params as $key => $value)
        {
            $this->{$key} = $value;
        }
    }

}