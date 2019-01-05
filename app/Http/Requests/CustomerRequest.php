<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'code' => 'required',
            'name' => 'required',
            'mobile1' => 'required',
            'email' => 'email|unique:users',
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'ຕ້ອງການລະຫັດລູກຄ້າ',
            'name.required' => 'ຕ້ອງການຊື່ ແລະ ນາມສະກຸນ',
            'mobile1.required' => 'ຕ້ອງການເບີໂທລະສັບ',
            'email.email' => 'ອີເມລ໌ບໍ່ຖືກຕ້ອງ',
            'email.unique' => 'ອີເມວ໌ນີ້ມີຄົນໃຊ້ໃນລະບົບຢູ່ແລ້ວ',
        ];
    }
}
