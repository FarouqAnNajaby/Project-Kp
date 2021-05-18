<?php

namespace App\Http\Controllers\Admin\ListAdminKasir;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Rules\HumanName;
use App\Models\Admin;
use App\Http\Controllers\Controller;

class ListKasirController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$data = Admin::where('role', 'kasir')->paginate();
		return view('admin.app.list-admin-kasir.kasir.index', compact('data'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('admin.app.list-admin-kasir.kasir.create');
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
			'username' => 'required|min:5|unique:admin,username',
			'nama'     => 'required|string|max:100',
			'password' => 'required|min:8|confirmed',
		]);

		Admin::create([
			'username' => $request->username,
			'nama'     => $request->nama,
			'password' => bcrypt($request->password),
			'role'     => 'kasir'
		]);

		alert()
			->success('Data berhasil ditambahkan.', 'Sukses!')
			->persistent('Tutup');
		return redirect()->route('admin.list-admin-kasir.kasir.index');
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
		return view('admin.app.list-admin-kasir.kasir.edit', compact('data'));
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
				'username' => ['required', 'min:5', Rule::unique('admin', 'username')->ignore($data->uuid, 'uuid')],
				'nama'     => ['required', new HumanName, 'min:1', 'max:100']
			]);
			$data->update($request->only('username', 'nama'));
			alert()
				->success('Data berhasil diubah.', 'Sukses!')
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
		return redirect()->route('admin.list-admin-kasir.kasir.edit', $data->uuid);
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

		return redirect()->route('admin.list-admin-kasir.kasir.index');
	}
}
