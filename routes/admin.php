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
* ->name			: Alias atau shortcut untuk memanggil route. Contoh: name('index),
*					  di controller/blade bisa dipanggil dengan route('index'), yang mana
*					  nanti hasilnya di url = http://website.com/admin
*/

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
	Route::get('/', 'HomeController@index')->name('index');
	Route::get('login', function () {
		return view('app.login');
	})->name('login');

	Route::namespace('MasterData')->prefix('master-data')->name('master-data.')->group(function () {

		Route::prefix('banner')->name('banner.')->group(function () {
			Route::get('/', 'BannerController@index')->name('index');
			Route::get('create', 'BannerController@create')->name('create');
			Route::post('store', 'BannerController@store')->name('store');
			Route::get('{data:uuid}/edit', 'BannerController@edit')->name('edit');
			Route::patch('{data:uuid}/update', 'BannerController@update')->name('update');
			Route::delete('{data:uuid}/delete', 'BannerController@destroy')->name('destroy');
		});

		Route::prefix('warna-barang')->name('warna-barang.')->group(function () {
			Route::get('/', 'WarnaBarangController@index')->name('index');
			Route::get('create', 'WarnaBarangController@create')->name('create');
			Route::post('store', 'WarnaBarangController@store')->name('store');
			Route::get('{uuid}/edit', 'WarnaBarangController@edit')->name('edit');
			Route::patch('{uuid}/update', 'WarnaBarangController@update')->name('update');
			Route::delete('{uuid}/delete', 'WarnaBarangController@destroy')->name('destroy');
		});

		Route::prefix('kategori-barang')->name('kategori-barang.')->group(function () {
			Route::get('/', 'KategoriBarangController@index')->name('index');
			Route::get('create', 'KategoriBarangController@create')->name('create');
			Route::post('store', 'KategoriBarangController@store')->name('store');
			Route::get('{uuid}/edit', 'KategoriBarangController@edit')->name('edit');
			Route::patch('{uuid}/update', 'KategoriBarangController@update')->name('update');
			Route::delete('{uuid}/delete', 'KategoriBarangController@destroy')->name('destroy');
		});

		Route::prefix('kategori-umkm')->name('kategori-umkm.')->group(function () {
			Route::get('/', 'KategoriUMKMController@index')->name('index');
			Route::get('create', 'KategoriUMKMController@create')->name('create');
			Route::post('store', 'KategoriUMKMController@store')->name('store');
			Route::get('{uuid}/edit', 'KategoriUMKMController@edit')->name('edit');
			Route::patch('{uuid}/update', 'KategoriUMKMController@update')->name('update');
			Route::delete('{uuid}/delete', 'KategoriUMKMController@destroy')->name('destroy');
		});
	});

	Route::namespace('UMKM')->prefix('umkm')->name('umkm.')->group(function () {
		Route::get('/', 'UMKMController@index')->name('index');
		Route::get('create', 'UMKMController@create')->name('create');
		Route::post('create', 'UMKMController@store')->name('store');
		Route::get('{data:uuid}/show', 'UMKMController@show')->name('show');
		Route::get('{data:uuid}/edit', 'UMKMController@edit')->name('edit');
		Route::patch('{data:uuid}/edit', 'UMKMController@update')->name('update');
		Route::delete('{data:uuid}/delete', 'UMKMController@destroy')->name('destroy');
	});

	Route::namespace('Barang')->prefix('barang')->name('barang.')->group(function () {
		Route::get('/', 'BarangController@index')->name('index');
		Route::get('create', 'BarangController@create')->name('create');
		Route::post('create', 'BarangController@store')->name('store');
		Route::get('{data:uuid}/edit', 'BarangController@edit')->name('edit');
		Route::patch('{data:uuid}/edit', 'BarangController@update')->name('update');
		Route::delete('{data:uuid}/delete', 'BarangController@destroy')->name('destroy');
		Route::get('{data:uuid}/send-whatsapp', 'BarangController@sendWhatsapp')->name('send-whatsapp');

		Route::prefix('{data:uuid}/foto')->name('foto.')->group(function () {
			Route::get('/', 'FotoController@index')->name('index');
			Route::get('create', 'FotoController@create')->name('create');
			Route::post('create', 'FotoController@store')->name('store');
			Route::delete('{uuid}/delete', 'FotoController@destroy')->name('destroy');
		});

		Route::prefix('log')->name('log.')->group(function () {
			Route::get('/', 'LogController@index')->name('index');
			Route::get('{data:uuid}/show', 'LogController@show')->name('show');
		});
	});
});
