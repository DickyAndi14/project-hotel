<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KamarRequest extends FormRequest
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
                'name' => 'required',
                'jumlah' => 'required',
                'banner' => 'mimes:jpeg,jpg,png|required',
                'tipe_kamar_id'   => 'required|max:20'
            ];
        }else if(request()->file('banner')){
            return [
                'name' => 'required',
                'banner' => 'mimes:jpeg,jpg,png',
                'tipe_kamar_id'   => 'required|max:20'
            ];
        }
        return [
            'jumlah' => 'required',
            'name' => 'required',
            'tipe_kamar_id'   => 'required|max:20'
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
