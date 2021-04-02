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
	Route::get('login', 'loginController@index')->name('login');
	Route::get('registration', 'loginController@create')->name('registration');

	// list cart
	Route::get('cart', 'CartController@index')->name('cart');

	//produk
	Route::get('pakaian', 'ProdukController@index')->name('pakaian');
	Route::get('minuman', 'ProdukController@index')->name('minuman');
	Route::get('snack', 'ProdukController@index')->name('snack');
	Route::get('aksesoris', 'ProdukController@index')->name('aksesoris');
	Route::get('produk', 'ProdukController@index')->name('produk');
	Route::get('makanan', 'ProdukController@index')->name('makanan');

	// show detail broduk
	Route::get('{data:uuid}/detail-barang', 'ProdukController@show')->name('detail-barang');

	// payment
	Route::get('payment', 'PaymentController@index')->name('payment');
	Route::post('sendPayment', 'PaymentController@create')->name('sendPayment');
});
