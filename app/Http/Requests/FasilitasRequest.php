<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FasilitasRequest extends FormRequest
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
        if($this->method() == 'store'){
            return [
                'desc' => 'required',
                'picture' => 'mimes:jpeg,jpg,png|required',
                'name'   => 'required|max:20'
            ];
        }else if(request()->file('picture')){
            return [
                'desc' => 'required',
                'picture' => 'mimes:jpeg,jpg,png',
                'name'   => 'required|max:20'
            ];
        }
        return [
            'desc'   => 'required',
            'name'   => 'required|max:20'
        ];
    }

    public function messages(){
        return [
            'required' => ':attribute harus diisi',
            'max'      => 'maksimal :max karakter',
            'mimes'      => 'banner harus bertipe :mimes',
        ];
    }
}
