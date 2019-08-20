<?php

namespace App\Http\Controllers\Api;

use App\Common\CacheCommon;
use App\Http\Controllers\BaseController;
use App\Models\Category;

class CategoryController extends BaseController
{
    public function index(Category $category)
    {
        $key = 'Categories';
        $CategoriesList = CacheCommon::getCache($key);

        if (!$CategoriesList) {
            $CategoriesList = $category->getAllData(['id', 'title']);
            CacheCommon::setKey($key, $CategoriesList);
        }

        return $this->response->array($CategoriesList)->setStatusCode(200);
    }
}
