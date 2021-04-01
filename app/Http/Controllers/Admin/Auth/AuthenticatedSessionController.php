<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Controllers\Controller;

class AuthenticatedSessionController extends Controller
{
	/**
	 * Display the login view.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		return view('admin.app.auth.login');
	}

	/**
	 * Handle an incoming authentication request.
	 *
	 * @param  \App\Http\Requests\Auth\LoginRequest  $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(LoginRequest $request)
	{
		$request->authenticate();

		$request->session()->regenerate();

		return redirect()->route('admin.index');
	}

	/**
	 * Destroy an authenticated session.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroy(Request $request)
	{
		Auth::guard('admin')->logout();

		// $request->session()->invalidate();

		$request->session()->regenerateToken();

		return redirect()->route('admin.auth.login');
	}
}
