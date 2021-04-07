<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\View\Components\Ecommerce\Kategori;
use App\View\Components\Ecommerce\Cart;
use App\View\Components\Ecommerce\Banner;
use App\View\Components\Admin\Breadcrumb;
use App\Models\BarangKategori;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		setLocale(LC_TIME, $this->app->getLocale());
		Blade::component('ecommerce-navbar-kategori', Kategori::class);
		Blade::component('ecommerce-banner', Banner::class);
		Blade::component('ecommerce-cart', Cart::class);
		Blade::component('admin-breadcrumb', Breadcrumb::class);
	}
}
