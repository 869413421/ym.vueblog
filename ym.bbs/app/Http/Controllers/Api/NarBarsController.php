<?php

namespace App\Http\Controllers\Api;

use App\Common\CacheCommon;
use App\Models\NarBar;
use App\Service\NarBarService;
use Faker\Provider\Base;

class NarBarsController extends Base
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
        return response()->json($narBarList)->setStatusCode(200);
    }
}
