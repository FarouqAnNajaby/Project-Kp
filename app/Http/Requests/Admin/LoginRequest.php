<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Events\Lockout;
use App\Models\Admin;

class LoginRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'username' => 'required|string',
			'password' => 'required|string',
		];
	}

	/**
	 * Attempt to authenticate the request's credentials.
	 *
	 * @return void
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function authenticate()
	{
		$this->ensureIsNotRateLimited();

		$user = Admin::where('username', $this->username);

		if ($user->count()) {
			if (!$user->where('role', 'admin')->count()) {
				$this->throwValidationError();
			} else {
				if (!Auth::guard('admin')->attempt($this->only('username', 'password'))) {
					$this->throwValidationError();
				}
			}
		} else {
			$this->throwValidationError();
		}

		RateLimiter::clear($this->throttleKey());
	}

	/**
	 * Ensure the login request is not rate limited.
	 *
	 * @return void
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function ensureIsNotRateLimited()
	{
		if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
			return;
		}

		event(new Lockout($this));

		$seconds = RateLimiter::availableIn($this->throttleKey());

		throw ValidationException::withMessages([
			'username' => trans('auth.throttle', [
				'seconds' => $seconds,
				'minutes' => ceil($seconds / 60),
			]),
		]);
	}

	/**
	 * Get the rate limiting throttle key for the request.
	 *
	 * @return string
	 */
	public function throttleKey()
	{
		return Str::lower($this->input('username')) . '|' . $this->ip();
	}

	public function throwValidationError()
	{
		RateLimiter::hit($this->throttleKey());

		throw ValidationException::withMessages([
			'username' => __('auth.failed'),
		]);
	}
}
