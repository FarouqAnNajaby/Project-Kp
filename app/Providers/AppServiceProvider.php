<?php

namespace App\Providers;

use App\View\Components\Admin\Breadcrumb;
use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
		Blade::component('admin-breadcrumb', Breadcrumb::class);
	}
}
