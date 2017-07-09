<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdmSpkPg
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check() OR (Auth::user()->type !== 'admin') AND Auth::user()->type !== 'spk' AND Auth::user()->type !== 'pegawai') {
            return redirect('login');
        }

        return $next($request);
    }
}
