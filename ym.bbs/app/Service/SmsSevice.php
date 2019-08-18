<?php
/**
 * Created by PhpStorm.
 * User: 、、、、、、、、、、、
 * Date: 2019/7/4
 * Time: 22:46
 */

namespace App\Service;


use Qcloud\Sms\SmsSingleSender;

class SmsSevice
{
    private $appId;
    private $appKey;
    private $templateId;
    private $smsSign;
    private $ssdener;
    public static $instance = null;

    private function __construct()
    {
        $this->initParams();
    }

    private function initParams()
    {
        $this->appId = config('sms.appId');
        $this->appKey = config('sms.appKey');
        $this->templateId = config('sms.templateId');
        $this->smsSign = config('sms.sign');
        $this->ssdener = new SmsSingleSender($this->appId, $this->appKey);
    }

    private function __clone()
    {

    }

    public static function getSmsServiceSingleTon()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function sendSms($phone, $code, $time)
    {
        try {
            $params = [$code, $time];

            $result = $this->ssdener->sendWithParam("86", $phone, $this->templateId,
                $params, $this->smsSign);
            $respone = json_decode($result);
            return $respone;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    
}