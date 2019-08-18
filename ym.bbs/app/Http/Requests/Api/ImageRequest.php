<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'type' => 'required|string|in:avatar,topic'
        ];

        if ($this->type == 'avatar') {
            $rules['image'] = 'required|mimes:jpg,jpeg,bmp,gif,png|dimensions:min_width=100,min_height=200';
        } else {
            $rules['image'] = 'required|mimes:jpg,jpeg,bmp,gif,png';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'image.dimensions' => '请上传宽高大于200px的图片'
        ];
    }
}
