<?php
/**
 * Created by PhpStorm.
 * User: 、、、、、、、、、、、
 * Date: 2019/7/7
 * Time: 20:58
 */

namespace App\Common;


use Illuminate\Support\Facades\Cache;

class CacheCommon
{
    public static function setKey($key, $value, $time = 600)
    {
        return Cache::put($key, $value, $time);
    }

    public static function getCache($key)
    {
        if (!Cache::has($key)) {
            return null;
        }
        return Cache::get($key);
    }

    public static function deleteKey($key)
    {
        if (Cache::has($key)) {
            return Cache::forget($key);
        }
        return false;
    }
}