<?php
/**
 * Created by PhpStorm.
 * User: 、、、、、、、、、、、
 * Date: 2019/7/3
 * Time: 23:09
 */

namespace App\Service;


class NarBarService
{
    public function getNarbarArr($arr, $id = '', $level = 0)
    {
        $list = [];
        foreach ($arr as $k => $v) {
            if ($v['pid'] == $id) {
                $v['level'] = $level;
                $v['child'] = $this->getNarbarArr($arr, $v['id'], $level + 1);
                $v['id'] = (string)$v['id'];
                $list[] = $v;
            }
        }
        return $list;
    }
}