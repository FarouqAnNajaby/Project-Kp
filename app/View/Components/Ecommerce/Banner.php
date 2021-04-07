<?php

namespace App\View\Components\Ecommerce;

use Illuminate\View\Component;
use App\Models\Banner as ModelsBanner;

class Banner extends Component
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
		$data = ModelsBanner::get();
		return view('ecommerce.partials.banner', compact('data'));
	}
}
