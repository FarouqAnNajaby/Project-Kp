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

	Route::prefix('umkm')->group(function () {

		Route::get('/', 'UMKMController@index')->name('admin.umkm.index');

		Route::get('create', 'UMKMController@create')->name('admin.umkm.create');

		Route::get('edit', 'UMKMController@edit')->name('admin.umkm.edit');
	});

	Route::prefix('barang')->group(function () {

		Route::get('/', 'BarangController@index')->name('admin.barang.index');

		Route::get('create', 'BarangController@create')->name('admin.barang.create');

		Route::get('edit', 'BarangController@edit')->name('admin.barang.edit');

		Route::get('show', 'BarangController@show')->name('admin.barang.show');
	});
});

Route::namespace('Kasir')->prefix('kasir')->group(function () {

	Route::get('/', 'HomeController@index')->name('kasir.index');

	Route::prefix('transaksi')->group(function () {

		Route::get('/', 'TransaksiController@index')->name('kasir.transaksi.index');

		Route::get('show', 'TransaksiController@show')->name('kasir.transaksi.show');
	});

	Route::prefix('laporan')->group(function () {

		Route::get('/', 'LaporanController@index')->name('kasir.laporan.index');

		Route::get('show', 'LaporanController@show')->name('kasir.laporan.show');
	});
});



// require __DIR__ . '/auth.php';
