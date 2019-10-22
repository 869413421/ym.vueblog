<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ReplyRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
                return [
                    'content' => 'required|string|min:5|max:300',
                    'reply_user_id' => 'required'
                ];
                break;
        }
    }

    public function messages()
    {
        return [
            'required' => '缺少必填参数',
            'string' => '必须是字符串',
            'user_id' => '回复用户不存在'
        ];
    }
}
