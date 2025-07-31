<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PemeriksaanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
          'kdcab'=>'required', 'nodonor'=>'required',
          'noaftp.required' => 'noaftp kosong',
            'namadonor'=>'required', 'tgllahir'=>'required',
            'noaftp' => 'required',
            'tgldaftar'=>'required',
            'umur'=>'required', 'jk'=>'required',
            'nmcab'=>'required',
            'donorke'=>'required',
            'tensi'=>'required',
            'nadi'=>'required','suhu'=>'required',
            'brtbdn'=>'required','tgbdn'=>'required',
            'typektg'=>'required',
            'ccambil'=>'required','ecg'=>'required',
            'tolak'=>'required',
            'ketperiksa'=>'required', 'nmptgdr'=>'required',
            'almt' => 'required','kdptgdr' => 'required',
            
        ];
    }
}
