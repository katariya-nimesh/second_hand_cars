<?php

namespace App\Http\Middleware\Admin;

use App\Models\User;
use App\Models\Worker;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Unauthenticated
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

        if (session('logged_in')) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
