<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class TopicRequest extends FormRequest
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
        return [
            'title' => 'required|string|min:3',
            'content' => 'required|string|min:20',
            'categorie_id' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'required' => '缺少必填选项',
            'min' => '字符长度过短',
            'string' => '必须是字符串',
            'integer' => '必须是整形',
        ];
    }
}
