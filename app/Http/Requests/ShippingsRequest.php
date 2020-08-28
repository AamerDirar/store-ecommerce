<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingsRequest extends FormRequest
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
            'id' => 'required|exists:settings',
            'value' => 'required',
            'plain_value' => 'required|nullable|numeric'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'id.required' => 'رقم الطريقة مطلوب',
            'id.exists' => 'رقم الطريقة يكون داخل جدول الاعدادات',
            'value.required' => 'اسم الطريقة مطلوب',
            'plain_value.required' => 'قيمة التوصيل مطلوبة',
            'plain_value.nullable' => 'قيمة التوصيل يمكن ان تكون فارغة',
            'plain_value.numeric' => 'قيمة التوصيل يجب ان تكون رقمية'
        ];
    }
}
