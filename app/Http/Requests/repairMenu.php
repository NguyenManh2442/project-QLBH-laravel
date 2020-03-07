<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class repairMenu extends FormRequest
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
            'CategoryParent'=>'required',
            'CategoryChill1'=>'required',
            'CategoryChill2'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'CategoryParent.required'=>'Vui lòng nhập Menu cha!',
            'CategoryChill1.required'=>'Vui lòng nhập Menu con!',
            'CategoryChill2.required'=>'Vui lòng nhập Menu con!'
        ];
    }
}
