<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

class Role
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle(Request $request, Closure $next, $role)
	{
		$arrRole = explode('|', $role);
		if (in_array(\Auth::guard('admin')->user()->role, $arrRole)) {
			return $next($request);
		}
		abort(403);
	}
}
