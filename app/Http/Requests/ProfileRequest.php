<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,' . $this->id,
            'password' => 'nullable|confirmed|min:8'
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
            'name.required' => 'يجب إدخال اسم المدير',
            'email.required' => 'يجب إدخال البريد الإلكتروني',
            'email.email' => 'صيغة البريد الإلكتروني غير صحيحة',
            'email.uniques' => 'صيغة البريد الإلكتروني مكررة',
            'password.confirmed' => 'يجب تأكيد كلمة المرور',
            'password|min' => 'يجب أن تحتوي كلمة المرور على ٨ خانات'
        ];
    }
}
