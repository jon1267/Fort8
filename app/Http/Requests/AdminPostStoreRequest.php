<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminPostStoreRequest extends FormRequest
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
            'title' => 'required|max:255',
            'body'  => 'required',
            'img'   => 'nullable|image|mimes:jpeg,jpg,png,bmp,svg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'required' => "Нужно заполнить поле :attribute.",
            'image' => "Поле :attribute должно быть изображением до 2 Мб .",
            'mimes' => "Поле :attribute должно быть изображением до 2 Мб .",
            'max' => 'Очень большой размер. Попробуйте уменьшить.'
        ];
    }
}
