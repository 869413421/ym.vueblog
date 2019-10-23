<?php

namespace App\Http\Controllers\Api;

use App\Common\CacheCommon;
use App\Http\Controllers\BaseController;
use App\Models\NarBar;
use App\Service\NarBarService;

class NarBarsController extends BaseController
{
    public function index(Narbar $narBar, NarBarService $narBarService)
    {
        $key = 'narbar';
        $narBarList = CacheCommon::getCache($key);

        if ($narBarList == null) {
            $narBarArr = $narBar->getAllData(['id', 'name', 'pid']);
            $narBarList = $narBarService->getNarbarArr($narBarArr);
            CacheCommon::setKey($key, $narBarList);
        }
        return $this->response()->array($narBarList)->setStatusCode(200);
    }
}
