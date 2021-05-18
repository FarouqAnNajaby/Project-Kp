<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Closure;
use App\Providers\RouteServiceProvider;

class RedirectIfAuthenticated
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @param  string|null  ...$guards
	 * @return mixed
	 */
	public function handle(Request $request, Closure $next, $guard = null)
	{

		if ($guard == "super_admin" && Auth::guard('admin')->check()) {
			return redirect('/admin');
		} else if ($guard == "admin" && Auth::guard($guard)->check()) {
			return redirect('/admin');
		} else if ($guard == "kasir" && Auth::guard($guard)->check()) {
			return redirect('/kasir');
		}
		if (Auth::guard($guard)->check()) {
			return redirect('/');
		}

		return $next($request);
		// $guards = empty($guards) ? [null] : $guards;

		// foreach ($guards as $guard) {
		//     if (Auth::guard($guard)->check()) {
		//         return redirect(RouteServiceProvider::HOME);
		//     }
		// }

		// return $next($request);
	}
}
