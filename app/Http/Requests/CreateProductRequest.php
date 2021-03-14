<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            "product_name" => "required|max:255",
            "supplier" => "required|max:255",
            "quantity" => "required|numeric",
            "unit_price" => "required|numeric",
            "discount" => "required|numeric",
            "description" => "required",
            'size' => 'required_without_all:size_s,size_m,size_l,size_xl,size_xxl',
            'image'=>'required',
            "category_1" => "required",
            "category_2" => "required",
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules = [
                "product_name" => "required|max:255",
                "supplier" => "required|max:255",
                "quantity" => "required|numeric",
                "unit_price" => "required|numeric",
                "discount" => "required|numeric",
                "description" => "required",
                'size' => 'required_without_all:size_s,size_m,size_l,size_xl,size_xxl',
                "category_1" => "required",
                "category_2" => "required",
            ];
        }
        return $rules;
    }
}
