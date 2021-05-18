<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Rules\HumanName;
use App\Models\Admin;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$validation = [
			'username' => 'required|string|min:8|max:20'
		];

		if (Auth::guard('admin')->user()->role == 'admin') {
			$validation = Arr::add($validation, 'nama', ['required', new HumanName, 'min:1', 'max:100']);
		}

		$request->validate($validation);

		$user = Auth::guard('admin')->user();

		if (Auth::guard('admin')->user()->role == 'admin') {
			$data = $request->only('username', 'nama');
		} else {
			$data = $request->only('username');
		}

		$user->update($data);
		alert()
			->success('Data berhasil diubah.', 'Sukses!')
			->persistent('Tutup');
		return redirect()->route('admin.auth.settings');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit()
	{
		$data = Auth::guard('admin')->user();
		$route = 'admin';
		return view('admin.app.auth.settings', compact('data', 'route'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request)
	{
		$request->validate([
			'password' => 'required|string',
			'new_password' => 'required|string|min:8|confirmed',
		], [], [
			'password' => 'Password Lama',
			'new_password' => 'Password Baru'
		]);
		$user = Auth::guard('admin')->user();
		if (Hash::check($request->password, $user->password)) {
			$user->update([
				'password' => bcrypt($request->new_password)
			]);
			alert()
				->success('Password berhasil diubah.', 'Sukses!')
				->persistent('Tutup');
			return redirect()->route('admin.auth.settings');
		}
		return redirect()->back()->withErrors(['password' => 'Password Lama tidak valid.']);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
