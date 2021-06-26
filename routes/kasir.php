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

Route::namespace('Kasir')->prefix('kasir')->name('kasir.')->group(function () {

	Route::namespace('Auth')->middleware('guest:kasir')->group(function () {
		Route::get('login', 'AuthenticatedSessionController@create')->name('login');
		Route::post('login', 'AuthenticatedSessionController@store');
	});

	Route::middleware('auth:kasir')->group(function () {
		Route::get('/', 'HomeController@index')->name('index');
		Route::get('logout', 'Auth\AuthenticatedSessionController@destroy')->name('logout');

		Route::namespace('Auth')->name('auth.')->group(function () {
			Route::get('pengaturan', 'SettingsController@edit')->name('settings');
			Route::patch('pengaturan', 'SettingsController@store');
			Route::patch('change-password', 'SettingsController@update')->name('settings.password');
		});

		Route::prefix('transaksi')->name('transaksi.')->group(function () {
			Route::get('/', 'TransaksiController@index')->name('index');
			Route::get('{data:uuid}/show', 'TransaksiController@show')->name('show');
			Route::patch('{data:uuid}/show/{status}', 'TransaksiController@update')->name('update');
		});


		Route::prefix('laporan-umkm')->name('laporan-umkm.')->group(function () {
			Route::get('/', 'LaporanUMKMController@index')->name('index');
			Route::get('{data:uuid}/show', 'LaporanUMKMController@show')->name('show');
			Route::get('{data:uuid}/show/{uuid}/barang', 'LaporanUMKMController@transaksi')->name('transaksi');
			Route::post('{data:uuid}/show/export', 'LaporanUMKMController@export');
		});

		Route::prefix('laporan')->name('laporan.')->group(function () {
			Route::get('/', 'LaporanController@index')->name('index');
			Route::get('{uuid}/show', 'LaporanController@show')->name('show');
			Route::get('{data:uuid}/print', 'LaporanController@create')->name('print');
			Route::match(['get', 'post'], '{uuid}/whatsapp', 'LaporanController@store')->name('whatsapp');
		});

		Route::prefix('ajax')->name('ajax.')->group(function () {
			Route::get('{uuid}/getBarangByKategori', 'AjaxController@getBarangByKategori')->name('getBarangByKategori');
			Route::get('{uuid}/getDetailBarang', 'AjaxController@getDetailBarang')->name('getDetailBarang');
			Route::post('buyItems', 'AjaxController@store')->name('store');
		});
	});
});
