<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Enums\Condition;

class ExhibitionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' =>['required','string'],
            'description' => ['required', 'string','max:255'],
            'sell_image' => ['required', 'mimes:jpeg,png'],
            'category' => ['required', 'array'],
            'category.*' => ['required', 'integer', 'exists:categories,id'],
            'condition' => ['required', new Enum(Condition::class)],
            'price' => ['required', 'integer','min:0'],
            'brand' => ['nullable', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください',
            'description.required' => '商品の説明を入力してください',
            'description.max' => '255文字以下で入力してください',
            'sell_image.required' => '商品画像を選択してください',
            'sell_image.mimes' => '商品画像はpngまたはjpgのものを選択してください',
            'category.required' => 'カテゴリーを選択してください',
            'condition.required' => '商品の状態を選択してください',
            'price.required' => '販売価格を入力してください',
            'price.integer' => '販売価格は整数で入力してください',
            'price.min' => '販売価格は0円以上で入力してください',
        ];
    }
}
