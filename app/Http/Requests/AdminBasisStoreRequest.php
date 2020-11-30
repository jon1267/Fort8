<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminBasisStoreRequest extends FormRequest
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
            'title' => 'required|alpha|min:3|max:3|unique:basis',
            'description'  => 'required',
            'display'   => 'required'
        ];
    }
}
