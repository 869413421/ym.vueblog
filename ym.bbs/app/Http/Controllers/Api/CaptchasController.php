<?php

namespace App\Http\Controllers\Api;

use App\Common\CacheCommon;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Api\CaptchasRequest;
use Gregwar\Captcha\CaptchaBuilder;

class CaptchasController extends BaseController
{
    public function store(CaptchasRequest $request, CaptchaBuilder $captchaBuilder)
    {
        $phone = $request->phone;
        $key = 'captcha-' . $phone;
        $expiredAt = now()->addMinutes(2);
        $captcha = $captchaBuilder->build();
        CacheCommon::setKey($key, ['phone' => $phone, 'code' => $captcha->getPhrase()]);

        $result = [
            'key' => $key,
            'expiredAt' => $expiredAt,
            'captchaImageContent' => $captcha->inline()
        ];

        return $this->response->array($result)->setStatusCode(201);
    }
}
