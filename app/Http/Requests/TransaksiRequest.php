<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransaksiRequest extends FormRequest
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
            'kamar_id' => 'required',
            'jumlah'   => 'required',
            'checkout' => 'required',
            'checkin'  => 'required',
            'nama_tamu' => 'required',
            'no_hp'    => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute wajib diisi.'
        ];
    }
}
