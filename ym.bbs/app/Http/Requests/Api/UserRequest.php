<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            case "POST":
                return [
                    'phone' => 'required|string|unique:users',
                    'name' => 'required|string|between:3,10',
                    'password' => 'required|string|min:6',
                    'checkpassword' => 'required|string|min:6',
                    'verification_code' => 'required|string'
                ];
                break;
            case "PATCH":
                return [
                    'name' => 'required|string|between:3,10',
                    'nickname' => 'nullable|string|between:2,10',
                    'email' => 'nullable|email|unique:users',
                    'city' => 'nullable|string|between:2,100',
                    'company' => 'nullable|string|between:2,100',
                    'title' => 'nullable|string|between:2,100',
                    'introduction' => 'nullable|string|between:2,500',
                    'avatar' => 'nullable|string|between:2,200',
                ];
        }

    }

    public function messages()
    {
        return [
            'required' => '缺少参数',
            'phone.required' => '请输入电话号码',
            'phone.regex' => '电话号码不正确',
            'name.required' => '请填写姓名',
            'verification_code' => '请提交验证的CODE',
            'between' => '字符串超出长度限制',
        ];
    }
}
