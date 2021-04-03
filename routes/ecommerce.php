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

	// logg
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
		Route::get('riwayat-pembelian', 'HistoryController@index')->name('history');
		Route::get('{data:kode}/riwayat-pembelian', 'HistoryController@show')->name('history.show');
	});

	// list cart
	Route::get('cart', 'CartController@index')->name('cart');

	//produk
	Route::prefix('barang')->name('barang.')->group(function () {
		Route::get('/', 'ProdukController@index')->name('index');
		Route::get('{kode}/{slug}', 'ProdukController@show')->name('show');
	});

	// payment
	Route::get('payment', 'PaymentController@index')->name('payment');
	Route::post('sendPayment', 'PaymentController@create')->name('sendPayment');
});
