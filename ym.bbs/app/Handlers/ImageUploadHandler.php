<?php

namespace App\Handlers;

use Intervention\Image\Facades\Image;

class ImageUploadHandler
{
    protected $allow = ['gif', 'jpg', 'jpeg', 'bmp', 'png'];

    public function save($file, $floder, $file_fix, $max_width = false)
    {
        $ext = strtolower($file->getClientOriginalExtension()) ?: 'png';

        if (!in_array($ext, $this->allow)) {
            return false;
        }

        $floder_path = '/upload/images/' . $floder . '/' . now()->format('Y-m-d');
        $upload_path = public_path() . $floder_path;

        $file_name = $file_fix . '_' . now()->format('Y-m-d') . time() . '_' . str_pad(mt_rand(1, 100000), 5, 0, STR_PAD_LEFT) . '.' . $ext;
        $file->move($upload_path, $file_name);

        if ($ext != 'gif' && $max_width) {
            $this->resize("$upload_path/$file_name", $max_width);
        }

        // http://ymbbs.com/upload/images/avatar/2019-08-13/user_2019-08-131565709927_36510.png
        return config('app.url') . '/' . $floder_path . '/' . $file_name;
    }

    public function resize($file_path, $max_width)
    {
        $image = Image::make($file_path);
        $image->resize($max_width, null, function ($constraint) {
            // 设定宽度是 $max_width，高度等比例双方缩放
            $constraint->aspectRatio();
            // 防止裁图时图片尺寸变大
            $constraint->upsize();
        });
    }
}