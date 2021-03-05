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

Route::namespace('Admin')->prefix('admin')->group(function () {
	Route::get('/', 'HomeController@index')->name('admin.index');
	Route::get('login', function () {
		return view('admin.app.login');
	})->name('admin.login');

	Route::namespace('MasterData')->prefix('master-data')->group(function () {
		Route::prefix('warna')->group(function () {
			Route::get('/', 'WarnaController@index')->name('admin.master-data.warna.index');
			Route::get('create', 'WarnaController@create')->name('admin.master-data.warna.create');
			Route::post('store', 'WarnaController@store')->name('admin.master-data.warna.store');
			Route::get('{uuid}/edit', 'WarnaController@edit')->name('admin.master-data.warna.edit');
			Route::patch('{uuid}/update', 'WarnaController@update')->name('admin.master-data.warna.update');
			Route::delete('{uuid}/destroy', 'WarnaController@destroy')->name('admin.master-data.warna.destroy');
		});
	});

	Route::namespace('UMKM')->prefix('umkm')->group(function () {
		Route::get('/', 'UMKMController@index')->name('admin.umkm.index');
		Route::get('create', 'UMKMController@create')->name('admin.umkm.create');
		Route::get('{uuid}/edit', 'UMKMController@edit')->name('admin.umkm.edit');
		Route::delete('{uuid}/delete', 'UMKMController@destroy')->name('admin.umkm.destroy');
		Route::get('{uuid}/show', 'UMKMController@show')->name('admin.umkm.show');

		Route::prefix('kategori')->group(function () {
			Route::get('/', 'KategoriController@index')->name('admin.umkm.kategori.index');
			Route::get('create', 'KategoriController@create')->name('admin.umkm.kategori.create');
			Route::get('{uuid}/show', 'KategoriController@show')->name('admin.umkm.kategori.show');
			Route::delete('{uuid}/delete', 'KategoriController@destroy')->name('admin.umkm.kategori.destroy');
		});
	});

	Route::namespace('Barang')->prefix('barang')->group(function () {
		Route::get('/', 'BarangController@index')->name('admin.barang.index');
		Route::get('create', 'BarangController@create')->name('admin.barang.create');
		Route::get('edit', 'BarangController@edit')->name('admin.barang.edit');

		Route::prefix('gambar')->group(function () {
			Route::get('/', 'GambarController@index')->name('admin.barang.gambar.index');
			Route::get('create', 'GambarController@create')->name('admin.barang.gambar.create');
		});

		Route::prefix('history')->group(function () {
			Route::get('/', 'HistoryController@index')->name('admin.barang.history.index');
			Route::get('{uuid}/show', 'HistoryController@show')->name('admin.barang.history.show');
		});
	});
});
