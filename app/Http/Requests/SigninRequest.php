<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SigninRequest extends FormRequest
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
            'email'      => 'required|email',
            'password'   => 'required|between:8,16'
        ];
    }

    public function messages(){
        return [
            'required'  => ':attribute wajib diisi.',
            'email'     => 'format :attribute salah.',
            'between'   => ':attribute harus diantara :min - :max karakter.'
        ];
    }
}
