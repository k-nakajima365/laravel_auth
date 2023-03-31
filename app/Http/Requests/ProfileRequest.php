<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user()->id)],
        ];
    }

    public function messages(): array
    {
        return [
            'name.max' => '255文字までしか入力できません',
            'email.required' => '必須項目です',
            'email.email' => 'メールアドレスの形式で入力してください',
            'email.unique' => '既存のアカウントと重複しています',
        ];
    }
}
