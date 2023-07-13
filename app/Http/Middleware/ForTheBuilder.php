<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForTheBuilder
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->status == 2 || Auth::user()->status == 1000) {
                return $next($request);
            }else{
                return redirect()->route('frontend.index');
            }
        }else{
            return redirect()->route('frontend.index')->with('warning',__('locale.please_login_first'));
        }
    }
}
