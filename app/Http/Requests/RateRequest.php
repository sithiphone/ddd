<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RateRequest extends FormRequest
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
            'bath' => 'required|numeric',
            'dolar' => 'required|numeric',
            'erro' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'bath.required' => 'ຕ້ອງການອັດຕາແລກປ່ຽນສະກຸນບາດ',
            'bath.numeric' => 'ຕ້ອງເປັນຕົວເລກເທົ່ານັ້ນ',
            'dolar.required' => 'ຕ້ອງການອັດຕາແລກປ່ຽນສະກຸນໂດລາ',
            'dolar.numeric' => 'ຕ້ອງເປັນຕົວເລກເທົ່ານັ້ນ',
            'erro.required' => 'ຕ້ອງການອັດຕາແລກປ່ຽນສະກຸນເອີໂຣ',
            'erro.numeric' => 'ຕ້ອງເປັນຕົວເລກເທົ່ານັ້ນ',
        ];
    }
}
