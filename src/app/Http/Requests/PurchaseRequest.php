<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'payment_method' => ['required','string'],
            'zip_code' => ['required', 'string', 'regex:/^\d{3}-\d{4}$/'],
            'address' => ['required','string'],
            'building' => ['nullable', 'string'],
        ];
    }
    public function messages()
    {
        return [
            'payment_method.required' => '支払い方法を選択してください',
            'zip_code.required' => '郵便番号を入力してください',
            'zip_code.regex' => '郵便番号はハイフンを含めた8文字で入力してください',
            'address.required' => '住所を入力してください',
        ];
    }
}
