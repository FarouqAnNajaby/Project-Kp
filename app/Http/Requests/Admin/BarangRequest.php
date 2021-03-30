<?php

namespace App\Http\Requests\Admin;

use Illuminate\Support\Arr;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\MinWord;
use App\Rules\MaxWord;
use App\Rules\FilteredNumeric;
use App\Models\UMKM;
use App\Models\BarangKategori;

class BarangRequest extends FormRequest
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
		$kategori = BarangKategori::pluck('uuid');
		$kategori = implode(',', json_decode($kategori));

		$rules = [
			'nama'              => 'required|string|max:100',
			'kategori'          => 'required|in:' . $kategori,
			'stok'              => ['required', new FilteredNumeric],
			'harga'             => ['required', new FilteredNumeric],
			'deskripsi_singkat' => ['required', new MaxWord(50)],
			'deskripsi'         => ['required', 'string', new MinWord(50)]
		];

		if ($this->method() == 'POST') {
			$umkm  = UMKM::pluck('uuid');
			$umkm  = implode(',', json_decode($umkm));
			$rules = Arr::add($rules, 'umkm', 'required|in:' . $umkm);
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
			'umkm'              => 'UMKM',
			'nama'              => 'Nama Barang',
			'kategori'          => 'Kategori Barang',
			'stok'              => 'Stok Barang',
			'harga'             => 'Harga Barang/Satuan',
			'deskripsi_singkat' => 'Deskripsi Singkat Barang',
			'deskripsi'         => 'Deskripsi Barang',
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
			'umkm.required'     => ':Attribute wajib dipilih.',
			'kategori.required' => ':Attribute wajib dipilih.'
		];
	}
}
