<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

	Route::get('/', 'HomeController@index')->name('admin.index');

	Route::group(['prefix' => 'umkm'], function () {

		Route::get('/', 'UMKMController@index')->name('admin.umkm.index');

		Route::get('create', 'UMKMController@create')->name('admin.umkm.create');
	});
});




// require __DIR__ . '/auth.php';
