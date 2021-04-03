<?php

namespace App\Http\Controllers\Ecommerce\Auth;

use Propaganistas\LaravelPhone\PhoneNumber;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Rules\HumanName;
use App\Models\User;
use App\Http\Requests\Ecommerce\LoginRequest;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('ecommerce.app.auth.register');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$request->validate([
			'nama' => ['required', new HumanName(), 'max:255'],
			'email' => 'required|string|email:dns,spoof|max:255|unique:users',
			'jenis_kelamin' => 'required|in:laki_laki,perempuan',
			'nomor_telepon' => 'required|phone:ID',
			'tanggal_lahir' => 'nullable|date_format:Y-m-d',
			'password' => 'required|string|confirmed|min:8',
		]);

		$arr = $request->except('nomor_telepon', 'password', 'password_confirmation');
		$arr = Arr::add($arr, 'nomor_telepon', PhoneNumber::make($request->nomor_telepon, 'ID')->formatE164());
		$arr = Arr::add($arr, 'password', Hash::make($request->password));

		Auth::login($user = User::create($arr));

		event(new Registered($user));

		return redirect()->route('ecommerce.profile');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show()
	{
		return view('ecommerce.app.auth.login');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(LoginRequest $request)
	{
		$request->authenticate();

		$request->session()->regenerate();

		return redirect()->route('ecommerce.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request)
	{

		Auth::logout();

		$request->session()->invalidate();

		$request->session()->regenerateToken();

		return redirect()->route('ecommerce.logout');
	}
}
