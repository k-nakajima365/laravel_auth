<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;

class AuthController extends Controller
{
    // ログイン画面へ遷移
    public function create()
    {
        return view('auth.create', ['title' => 'ログイン']);
    }

    // ログイン
    // ホーム画面へリダイレクト
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    // ログアウト
    // トップ画面へリダイレクト
    public function destroy(Request $request)
    {
        \Auth::guard('web')->logout();

        $request->session()->invalidate();
        
        $request->session()->regenerateToken();

        return redirect()->route('top');
    }
}
