<?php

namespace App\Http\Controllers\Ecommerce\Auth;

use Propaganistas\LaravelPhone\PhoneNumber;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Rules\HumanName;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
	public function index()
	{
		return view('ecommerce.app.auth.profile');
	}

	public function update(Request $request)
	{
		$request->validate([
			'nama' => ['required', new HumanName(), 'max:255'],
			'jenis_kelamin' => 'required|in:laki_laki,perempuan',
			'tanggal_lahir' => 'sometimes|date_format:Y-m-d',
			'email' => 'required|email:dns,spoof',
			'nomor_telepon' => 'required|phone:ID'
		]);

		$no_telp = PhoneNumber::make($request->nomor_telepon, 'ID')->formatE164();

		$arr = $request->only('nama', 'jenis_kelamin', 'tanggal_lahir', 'email');
		$arr = Arr::add($arr, 'nomor_telepon', $no_telp);

		Auth::user()->update($arr);
		alert()
			->success('Data berhasil dubah.', 'Sukses!')
			->persistent('Tutup');

		return redirect()->route('ecommerce.profile');
	}

	public function store(Request $request)
	{
		$request->validate([
			'password' => 'required|string',
			'new_password' => 'required|string|min:8|confirmed',
		], [], [
			'password' => 'Password Lama',
			'new_password' => 'Password Baru'
		]);
		$user = Auth::user();
		if (Hash::check($request->password, $user->password)) {
			$user->update([
				'password' => bcrypt($request->new_password)
			]);
			alert()
				->success('Password berhasil diubah.', 'Sukses!')
				->persistent('Tutup');
			return redirect()->route('ecommerce.profile');
		}
		return redirect()->back()->withErrors(['password' => 'Password Lama tidak valid.']);
	}
}
