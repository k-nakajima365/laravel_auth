<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\Lockout;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => '必須項目です',
            'email.email' => 'メールアドレスの形式で入力してください',
            'password.required' => '必須項目です',
        ];
    }

    public function authenticate()
    {
        $this->ensureIsNotRateLimited();

        if (! \Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey(), 30);

            throw ValidationException::withMessages([
                'email' => 'メールアドレスかパスワードが間違っています',
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    public function ensureIsNotRateLimited()
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 3)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => "ログイン試行回数が3回を超えたため、アカウントをロックしました\n${seconds}秒後にロックが解除されるまでこのアプリケーションはご利用になれません",
        ]);
    }

    public function throttleKey()
    {
        return Str::lower($this->email).'|'.$this->ip();
    }
}
