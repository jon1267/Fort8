<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
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
            'name'  => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->user->id,
            'password' =>'nullable|between:8,25|confirmed'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => "Нужно заполнить поле :attribute.",
            'unique' => "Поле :attribute уже используется.",
            'email' => "Поле :attribute должно содержать корректный электронный адрес.",
            'between' => "Поле :attribute должно содержать от 8 до 25 символов.",
            'confirmed' => "Пароли не совпадают"
        ];;
    }
}
