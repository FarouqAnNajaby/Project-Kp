<?php

namespace App\Http\Requests\Admin;

use Illuminate\Support\Arr;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\UMKMKategori;

class UMKMRequest extends FormRequest
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
		$kategori = UMKMKategori::pluck('uuid');
		$kategori = implode(',', json_decode($kategori));

		$rules = [
			'nama'         => 'required|max:100',
			'kategori'     => 'required|in:' . $kategori,
			'nama_pemilik' => 'required|max:50',
			'email'        => 'required|email:dns,spoof',
			'nomor_telp'   => 'required|phone:ID',
			'alamat'       => 'required',
		];
		if ($this->method() == 'POST') {
			$rules = Arr::add($rules, 'syarat_ketentuan', 'required');
		} else if ($this->method() == 'PATCH') {
			$rules = Arr::prepend($rules, 'sometimes|mimes:jpg,jpeg,png|image|max:3072', 'logo');
		}
		return $rules;
	}

	/**
	 * Get custom attributes for validator errors.
	 *
	 * @return array
	 */
	public function attributes()
	{
		return [
			'nama'             => 'Nama UMKM',
			'kategori'         => 'Kategori UMKM',
			'nama_pemilik'     => 'Nama Pemilik UMKM',
			'email'            => 'Email UMKM',
			'nomor_telp'       => 'Nomor Telepon',
			'alamat'           => 'Alamat UMKM',
			'syarat_ketentuan' => 'Syarat dan Ketentuan'
		];
	}

	/**
	 * Get the error messages for the defined validation rules.
	 *
	 * @return array
	 */
	public function messages()
	{
		return [
			'kategori.required'         => ':Attribute wajib dipilih.',
			'syarat_ketentuan.required' => ':Attribute wajib dicentang.'
		];
	}
}
