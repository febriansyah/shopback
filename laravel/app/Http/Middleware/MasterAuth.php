<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MasterAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {


        if ($request->segment(1) == 'master' && $guard == 'backend' && ! Auth::guard('backend')->check()) {
            $tmp_login_redirect = url()->current();
            if ($request->ajax()) {
                $tmp_login_redirect = url()->previous();
            }

            session(['tmp_login_redirect' => $tmp_login_redirect]);

            return redirect()->route('master.auth.login');
        }

        return $next($request);
    }
}
