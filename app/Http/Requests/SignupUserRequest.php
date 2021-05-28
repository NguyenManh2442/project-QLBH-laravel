<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupUserRequest extends FormRequest
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
            'email' => 'email|unique:customers|max:100',
            'userName' => 'required|min:6|max:255',
            'password1' => 'required|min:6|max:255',
            'password2' => 'required|min:6|max:255|same:password1',
        ];
    }
}
