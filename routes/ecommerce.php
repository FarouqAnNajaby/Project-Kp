<?php

use Illuminate\Support\Facades\Route;

/*
* ->namespace 		: Lokasi Folder Controller
*
* ->prefix			: Parent path atau parent target url.
*					  Contoh: prefix('umkm') = http://website.com/umkm/create (Create hanya contoh)
*					  Contoh lain, di dalam route group prefix ada route group prefix lagi,
*					  prefix('barang') = http://website.com/umkm/barang/edit (Edit hanya contoh)
*
* ->name			: Alias atau shortcut untuk memanggil route. Contoh: name('admin.index),
*					  di controller/blade bisa dipanggil dengan route('admin.index'), yang mana
*					  nanti hasilnya di url = http://website.com/admin
*/

Route::namespace('Ecommerce')->name('ecommerce.')->group(function () {
	Route::get('/', 'BerandaController@index')->name('index');

	Route::namespace('Auth')->middleware('guest')->group(function () {
		Route::get('login', 'AuthController@show')->name('login');
		Route::post('login', 'AuthController@update');
		Route::get('register', 'AuthController@create')->name('register');
		Route::post('register', 'AuthController@store');
	});

	Route::middleware('auth')->group(function () {

		Route::namespace('Auth')->group(function () {
			Route::get('logout', 'AuthController@destroy')->name('logout');
			Route::get('profile', 'ProfileController@index')->name('profile');
			Route::patch('profile', 'ProfileController@update');
			Route::patch('change-password', 'ProfileController@store')->name('change-password');
		});
		Route::get('riwayat-transaksi', 'HistoryController@index')->name('history');
		Route::get('{data:kode}/riwayat-pembelian', 'HistoryController@show')->name('history.show');
		Route::get('{kode}/review', 'ReviewController@index')->name('review.index');
		Route::get('{kode}/review/{uuid}', 'ReviewController@create')->name('review.create');
		Route::post('{kode}/review/{uuid}', 'ReviewController@store')->name('review.store');

		Route::prefix('keranjang')->name('cart.')->group(function () {
			Route::get('/', 'CartController@index')->name('index');
			Route::patch('/', 'CartController@update')->name('update');
			Route::delete('/', 'CartController@destroy')->name('destroy');
		});
		Route::prefix('checkout')->name('checkout.')->group(function () {
			Route::get('/', 'CartController@create')->name('index');
			Route::post('/', 'CartController@store')->name('store');
		});
	});

	Route::get('etalase/{kode}', 'EtalaseController@index')->name('etalase');

	Route::prefix('barang')->name('barang.')->group(function () {
		Route::get('/', 'ProdukController@index')->name('index');
		Route::get('{kode}/{slug}', 'ProdukController@show')->name('show');
		Route::post('{kode}/{slug}', 'ProdukController@store')->name('store');
	});

	Route::get('bantuan', function () {
		return view('ecommerce.app.bantuan');
	})->name('bantuan');
});
