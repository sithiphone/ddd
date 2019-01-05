<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuotation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product' => 'required',
            'descript' => 'required',
            'amount' => 'required|numeric',
            'price' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'product.required' => 'ກະລຸນາປ້ອນຂໍ້ມູນລາຍການສິນຄ້າ',
            'descript.required'  => 'ກະລຸນາປ້ອນຂໍ້ມູນລາຍລະອຽດສິນຄ້າເພີ່ມເຕີມ',
            'amount.required' => 'ກະລຸນາປ້ອນຈຳນວນສິນຄ້າ',
            'price.required' => 'ກະລຸນາປ້ອນລາຄາສະເໜີລາຄາ',
        ];
    }
}
