<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Admin;

class AuthServiceProvider extends ServiceProvider
{
	/**
	 * The policy mappings for the application.
	 *
	 * @var array
	 */
	protected $policies = [
		// 'App\Models\Model' => 'App\Policies\ModelPolicy',
	];

	/**
	 * Register any authentication / authorization services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->registerPolicies();

		Gate::define('super-admin', function (Admin $user) {
			return $user->role == 'super_admin';
		});
		Gate::define('admin', function (Admin $user) {
			return $user->role == 'admin';
		});
		Gate::define('kasir', function (Admin $user) {
			return $user->role == 'kasir';
		});
	}
}
