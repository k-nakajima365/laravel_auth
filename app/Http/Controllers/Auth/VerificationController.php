<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Events\Updated;
use App\Providers\RouteServiceProvider;

class VerificationController extends Controller
{
    // メール認証
    // ホーム画面へリダイレクト
    public function verify(Request $request)
    {
        if ($request->user()->updated_at->addSeconds(config('auth.verification.expire', 86400)) < now()) {
            return redirect()->route('verification.expired');
        }
        
        if ($request->user()->email_verified_at == null) {
            $request->user()->email_verified_at = now();
            $request->user()->save();
        }

        if (session('isregistered')) {
            session()->forget('isregistered');
            return redirect()->intended(RouteServiceProvider::HOME)->with('status', 'home-registered');
        } else {
            session()->forget('isregistered');
            return redirect()->route('profile.show')->with('status', 'profile-updated');
        }
    }

    // メール再送
    // 仮登録完了画面へリダイレクト
    public function retry(Request $request)
    {
        $user = $request->user();
        $user->updated_at = now();
        $user->save();

        if (session('isregistered')) {
            event(new Registered($request->user()));

            return redirect()->route('completed.register');
        } else {
            event(new Updated($request->user()));

            return redirect()->route('completed.update');
        }
    }

    // メール再送
    // 仮登録完了画面へリダイレクト
    public function expired(Request $request)
    {
        $user = $request->user();
        $user->updated_at = now();
        $user->save();

        if (session('isregistered')) {
            event(new Registered($request->user()));

            return redirect()->route('completed.register')->with('status', 'expired');
        } else {
            event(new Updated($request->user()));
            
            return redirect()->route('completed.update')->with('status', 'expired');
        }
    }
}
