<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'profile_image' => ['mimes:jpeg,png'],
            'name' => ['required', 'string', 'max:20'],
            'zip_code' => ['required', 'string', 'regex:/^\d{3}-\d{4}$/'],
            'address' => ['required', 'string'],
            'building' => ['nullable','string'],
        ];
    }

    public function messages()
    {
        return [
            'profile_image.mimes' => '拡張子はjpgまたはpng形式にしてください',
            'name.required' => 'お名前を入力してください',
            'name.max' => 'お名前は20文字以下で入力してください',
            'zip_code.required' => '郵便番号を入力してください',
            'zip_code.regex' => '郵便番号はハイフンを含めた8文字で入力してください',
            'address.required' => '住所を入力してください',
        ];
    }
}
