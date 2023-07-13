<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Session;
use Config;

use Illuminate\Http\Request;

class Language
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
        
        if(session()->has('locale')){
            $locale = session('locale');
        }
         else{
            $locale = env('DEFAULT_LANGUAGE','ru');
         }
        //  dd($locale);
         App::setLocale($locale);
        $request->session()->put('locale', $locale);

        return $next($request);
    }
}
