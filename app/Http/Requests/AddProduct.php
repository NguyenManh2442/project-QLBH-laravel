<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProduct extends FormRequest
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
            'productName'=>'required',
            'unitPrice'=>'required|numeric',
            'quantity'=>'required|numeric',
            'fileImg'=>'required',
            'menucon'=>'required',
            'mota'=>'required'
        ];
    }
     public function messages()
     {
         return [
             'productName.required'=>'Vui lòng không để trống tên sản phẩm!',
             'unitPrice.required'=>'Vui lòng không để trống giá sản phẩm!',
             'unitPrice.numeric'=>'Vui lòng ghi số!',
             'quantity.required'=>'Vui lòng không để trống số lượng sản phẩm!',
             'quantity.numeric'=>'Vui lòng ghi số!',
             'fileImg.required'=>'Vui lòng không để trống ảnh sản phẩm!',
             'menucon.required'=>'Vui lòng chọn menu con!',
             'mota.required'=>'Vui lòng nhập mô tả sản phẩm!',

         ];
     }
}
