<?php

namespace App\View\Components\Ecommerce;

use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Cart extends Component
{
	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Get the view / contents that represent the component.
	 *
	 * @return \Illuminate\Contracts\View\View|\Closure|string
	 */
	public function render()
	{
		$user = Auth::user();
		$data = $user->Keranjang()
			->join('barang', 'keranjang.uuid_barang', '=', 'barang.uuid')
			->where('barang.stok', '>', 0)
			->whereNull('barang.deleted_at')
			->orderBy('keranjang.updated_at', 'asc');
		$total_item = $data->count();
		$total_pay = $user->Keranjang()
			->join('barang', 'keranjang.uuid_barang', '=', 'barang.uuid')
			->select(DB::raw('SUM(keranjang.jumlah*barang.harga) as total'))
			->where('barang.stok', '>', 0)
			->whereNull('barang.deleted_at')
			->first()->total;
		$total_pay = 'Rp' . number_format($total_pay, 2, ',', '.');
		return view('ecommerce.partials.cart', compact('data', 'total_item', 'total_pay'));
	}
}
