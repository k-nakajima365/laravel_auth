<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Events\Updated;

class ProfileController extends Controller
{
    // プロフィール画面へ遷移
    public function show(Request $request)
    {
        return view('profile.show', [
            'title' => 'プロフィール',
            'user' => $request->user(),
        ]);
    }

    // プロフィール編集画面へ遷移
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'title' => 'プロフィール編集',
            'user' => $request->user(),
        ]);
    }

    // プロフィール更新
    // ユーザ登録完了画面ORプロフィール画面へリダイレクト
    public function update(ProfileRequest $request)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if ($request->user()->name == null) {
            $request->user()->name = '';
        }
        $request->user()->save();

        if (! $request->user()->hasVerifiedEmail()) {
            session(['isregistered' => false]);
            
            event(new Updated($request->user()));

            return redirect()->route('completed.update');
        } else {
            return redirect()->route('profile.show')->with('status', 'profile-updated');
        }
    }

    // ユーザ削除
    public function destroy(Request $request)
    {
        $request->validate(
            [
                'password' => ['required', 'current-password'],
            ],
            [
                'password.required' => '必須項目です',
                'password.current_password' => 'パスワードが間違っています',
            ]
        );

        $user = $request->user();

        \Auth::logout($user);

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('top');
    }
}
