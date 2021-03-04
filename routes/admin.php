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

	Route::namespace('UMKM')->prefix('umkm')->group(function () {
		Route::get('/', 'UMKMController@index')->name('admin.umkm.index');
		Route::get('create', 'UMKMController@create')->name('admin.umkm.create');
		Route::get('{uuid}/edit', 'UMKMController@edit')->name('admin.umkm.edit');
		Route::delete('{uuid}/delete', 'UMKMController@destroy')->name('admin.umkm.destroy');

		Route::prefix('kategori')->group(function () {
			Route::get('/', 'KategoriController@index')->name('admin.umkm.kategori.index');
			Route::get('create', 'KategoriController@create')->name('admin.umkm.kategori.create');
			Route::get('edit', 'KategoriController@edit')->name('admin.umkm.kategori.edit');
		});
	});

	Route::prefix('barang')->namespace('Barang')->group(function () {
		Route::get('/', 'BarangController@index')->name('admin.barang.index');
		Route::get('create', 'BarangController@create')->name('admin.barang.create');
		Route::get('edit', 'BarangController@edit')->name('admin.barang.edit');

		Route::prefix('gambar')->group(function () {
			Route::get('/', 'GambarController@index')->name('admin.barang.gambar.index');
			Route::get('create', 'GambarController@create')->name('admin.barang.gambar.create');
		});

		Route::prefix('history')->group(function () {
			Route::get('/', 'HistoryController@index')->name('admin.barang.history.index');
			Route::get('detail', 'HistoryController@show')->name('admin.barang.history.show');
		});
	});
});
