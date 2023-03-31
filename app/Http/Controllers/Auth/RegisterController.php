<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisterController extends Controller
{
    // ユーザ作成画面へ遷移
    public function create()
    {
        return view('register.create', ['title' => 'ユーザ登録']);
    }

    // ユーザ作成
    // ログイン
    // ユーザ登録完了画面へリダイレクト
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => ['max:255'],
                'email' => ['required', 'email', 'unique:users'],
                'password' => ['required', Password::defaults(), 'confirmed'],
            ],
            [
                'name.max' => '255文字までしか入力できません',
                'email.required' => '必須項目です',
                'email.email' => 'メールアドレスの形式で入力してください',
                'email.unique' => '既存のアカウントと重複しています',
                'password.required' => '必須項目です',
                'password.min' => '8文字以上入力してください',
                'password.confirmed' => 'パスワードが間違っています',
            ]
        );

        $user = User::create([
            'name' => $request->name?: '',
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        session(['isregistered' => true]);

        event(new Registered($user));

        \Auth::login($user);

        return redirect()->route('completed.register')->with('status', 'registered');
    }
}
