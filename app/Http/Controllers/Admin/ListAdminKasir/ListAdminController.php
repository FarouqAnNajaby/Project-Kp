<?php

namespace App\Http\Controllers\Admin\ListAdminKasir;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Controllers\Controller;

class ListAdminController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$data = Admin::where('role', 'admin')->paginate();
		return view('admin.app.list-admin-kasir.admin.index', compact('data'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('admin.app.list-admin-kasir.admin.create');
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
			'username' => 'required|unique:admin,username',
			'nama'     => 'required|string|max:100',
			'password' => 'required|min:8|confirmed',
		]);

		Admin::create([
			'username' => $request->username,
			'nama'     => $request->nama,
			'password' => bcrypt($request->password),
			'role'     => 'admin'
		]);

		alert()
			->success('Data berhasil ditambahkan.', 'Sukses!')
			->persistent('Tutup');
		return redirect()->route('admin.list-admin-kasir.admin.index');
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
	public function edit(Admin $data)
	{
		return view('admin.app.list-admin-kasir.admin.edit', compact('data'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Admin $data)
	{
		if ($request->isMethod('PATCH')) {
			$request->validate([
				'username' => ['required', Rule::unique('admin', 'username')->ignore($data->uuid, 'uuid')]
			]);
			$data->update($request->only('username'));
			alert()
				->success('Username berhasil diubah.', 'Sukses!')
				->persistent('Tutup');
		} else {
			$request->validate([
				'password' => 'required|min:8|confirmed'
			]);
			$data->update([
				'password' => bcrypt($request->password)
			]);
			alert()
				->success('Password berhasil diubah.', 'Sukses!')
				->persistent('Tutup');
		}
		return redirect()->route('admin.list-admin-kasir.admin.edit', $data->uuid);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Admin $data)
	{
		$data->delete();
		alert()
			->success('Data berhasil dihapus.', 'Sukses!')
			->persistent('Tutup');

		return redirect()->route('admin.list-admin-kasir.admin.index');
	}
}
