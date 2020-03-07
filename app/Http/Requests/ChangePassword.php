<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePassword extends FormRequest
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
            'password'=>'required',
            'newPassword1'=>'required',
            'newPassword2'=>'required|same:newPassword1'
        ];
    }
    public function messages()
    {
        return [
            'password.required'=>'Vui lòng nhập mật khẩu cũ!',
            'newPassword1.required'=>'Vui lòng nhập mật mới!',
            'newPassword2.required'=>'Vui lòng nhập lại mật khẩu mới!',
            'newPassword2.same'=>'Mật khẩu mới không trùng nhau!'
        ];
    }
}
