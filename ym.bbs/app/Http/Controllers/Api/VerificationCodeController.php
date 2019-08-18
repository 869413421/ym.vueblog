<?php

namespace App\Http\Controllers\Api;

use App\Common\CacheCommon;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Api\VerificationCodeRequest;
use App\Service\SmsSevice;

class VerificationCodeController extends BaseController
{
    public function store(VerificationCodeRequest $request)
    {
        $phone = $request->phone;
        $code = random_int(000001, 999999);
        $smsSevice = SmsSevice::getSmsServiceSingleTon();
        $responeSms = $smsSevice->sendSms($phone, $code, 5);
        $key = $phone . $code;

        CacheCommon::setKey($key, $code);

        if ($responeSms->result == 0) {
            return $this->response->created();
        } else {
            return $this->response->error('短信发送失败', 400);
        }

    }
}
