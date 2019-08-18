<?php

namespace App\Http\Controllers\Api;

use App\Handlers\ImageUploadHandler;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Api\ImageRequest;
use App\Models\Image;
use App\Transformers\ImageTransformer;

class ImageController extends BaseController
{
    public function store(ImageRequest $request, ImageUploadHandler $upload, Image $image)
    {
        $user = $this->user();
        $max_width = $request->type == 'avatar' ? 306 : 1024;
        $path = $upload->save($request->image, 'avatar', 'user', $max_width);

        $image->type = $request->type;
        $image->user_id = $user->id;
        $image->path = $path;
        $image->save();

        return $this->response->item($image, new ImageTransformer);
    }
}
