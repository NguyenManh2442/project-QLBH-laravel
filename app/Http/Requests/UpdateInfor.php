<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInfor extends FormRequest
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
            'username'=>'required',
            'fullName'=>'required',
            'phone'=>'required|numeric',
            'address'=>'required',
            'birthDate'=>'required',
        ];
    }
    public function messages()
    {
       return [
           'username.required'=>'Vui lòng nhập username!',
           'fullName.required'=>'Vui lòng nhập đầy đủ họ và tên!',
           'phone.required'=>'Vui lòng nhập số điện thoại!',
           'phone.numeric'=>'Vui lòng nhập số!',
           'address.required'=>'Vui lòng nhập địa chỉ!',
           'birthDate.required'=>'Vui lòng nhập đầy đủ ngày, tháng, năm sinh!'
       ];
    }
}
