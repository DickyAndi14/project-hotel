<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
            'name'       => 'required|max:10',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|between:8,16'
        ];
    }

    public function messages(){
        return [
            'required'  => ':attribute wajib diisi.',
            'max'       => ':attribute maksimal adalah :max.',
            'email'     => 'format :attribute salah.',
            'unique'    => ':attribute sudah digunakan.',
            'between'   => ':attribute harus diantara :min - :max karakter.'
        ];
    }
}
