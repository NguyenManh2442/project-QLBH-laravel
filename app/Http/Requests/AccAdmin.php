<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccAdmin extends FormRequest
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
            'email'=>'required',
            'fullName'=>'required',
            'phone'=>'required',
            'password1'=>'required',
            'password2'=>'required|same:password1'
        ];
    }
    public function messages()
    {
        return [
            'email.required'=>'Vui lòng nhập email!',
            'fullName.required'=>'Vui lòng nhập họ và tên!',
            'phone.required'=>'Vui lòng nhập số điện thoại!',
            'password1.required'=>'Vui lòng nhập mật khẩu!',
            'password2.required'=>'Vui lòng nhập lại mật khẩu!',
            'password2.same'=>'Mật khẩu không trùng nhau!'
        ];
    }
}
