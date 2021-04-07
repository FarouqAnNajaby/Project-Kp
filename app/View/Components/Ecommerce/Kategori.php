<?php

namespace App\View\Components\Ecommerce;

use Illuminate\View\Component;
use App\Models\BarangKategori;

class Kategori extends Component
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
		$kategori = BarangKategori::where('is_dropdown', 1)->get();
		return view('ecommerce.partials.navbar-kategori', compact('kategori'));
	}
}
