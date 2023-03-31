<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $redirectToRoute = null)
    {
        if (! $request->user() ||
            ! $request->user()->hasVerifiedEmail()) {
            return $request->expectsJson()
                    ? abort(403, "本登録が完了していません。\nメールのリンクをクリックして本登録を完了してください。")
                    : redirect()->guest(route($redirectToRoute ?: 'verification.retry'));
        }

        return $next($request);
    }
}
