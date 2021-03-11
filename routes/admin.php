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

		Route::prefix('warna-barang')->group(function () {
			Route::get('/', 'WarnaBarangController@index')->name('admin.master-data.warna-barang.index');
			Route::get('create', 'WarnaBarangController@create')->name('admin.master-data.warna-barang.create');
			Route::post('store', 'WarnaBarangController@store')->name('admin.master-data.warna-barang.store');
			Route::get('{uuid}/edit', 'WarnaBarangController@edit')->name('admin.master-data.warna-barang.edit');
			Route::patch('{uuid}/update', 'WarnaBarangController@update')->name('admin.master-data.warna-barang.update');
			Route::delete('{uuid}/delete', 'WarnaBarangController@destroy')->name('admin.master-data.warna-barang.destroy');
		});

		Route::prefix('kategori-barang')->group(function () {
			Route::get('/', 'KategoriBarangController@index')->name('admin.master-data.kategori-barang.index');
			Route::get('create', 'KategoriBarangController@create')->name('admin.master-data.kategori-barang.create');
			Route::post('store', 'KategoriBarangController@store')->name('admin.master-data.kategori-barang.store');
			Route::get('{uuid}/edit', 'KategoriBarangController@edit')->name('admin.master-data.kategori-barang.edit');
			Route::patch('{uuid}/update', 'KategoriBarangController@update')->name('admin.master-data.kategori-barang.update');
			Route::delete('{uuid}/delete', 'KategoriBarangController@destroy')->name('admin.master-data.kategori-barang.destroy');
		});
	});

	Route::namespace('UMKM')->prefix('umkm')->group(function () {
		Route::get('/', 'UMKMController@index')->name('admin.umkm.index');
		Route::get('create', 'UMKMController@create')->name('admin.umkm.create');
		Route::post('store', 'UMKMController@store')->name('admin.umkm.store');
		Route::get('{uuid}/show', 'UMKMController@show')->name('admin.umkm.show');
		Route::get('{uuid}/edit', 'UMKMController@edit')->name('admin.umkm.edit');
		Route::patch('{uuid}/update', 'UMKMController@update')->name('admin.umkm.update');
		Route::delete('{uuid}/delete', 'UMKMController@destroy')->name('admin.umkm.destroy');
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
