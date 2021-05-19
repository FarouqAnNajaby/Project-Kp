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

	Route::namespace('Auth')->middleware('guest:admin')->name('auth.')->group(function () {
		Route::get('login', 'AuthenticatedSessionController@create')->name('login');
		Route::post('login', 'AuthenticatedSessionController@store');
	});

	Route::middleware('auth:admin')->group(function () {
		Route::get('/', 'HomeController@index')->name('index');
		Route::get('logout', 'Auth\AuthenticatedSessionController@destroy')->name('logout');

		Route::namespace('ListAdminKasir')->prefix('list-admin-kasir')->name('list-admin-kasir.')->middleware('role:super_admin')->group(function () {
			Route::prefix('admin')->name('admin.')->group(function () {
				Route::get('/', 'ListAdminController@index')->name('index');
				Route::get('create', 'ListAdminController@create')->name('create');
				Route::post('create', 'ListAdminController@store')->name('store');
				Route::get('{data:uuid}/edit', 'ListAdminController@edit')->name('edit');
				Route::match(['patch', 'put'], '{uuid}/update', 'ListAdminController@update')->name('update');
				Route::delete('{data:uuid}/delete', 'ListAdminController@destroy')->name('destroy');
			});
			Route::prefix('kasir')->name('kasir.')->group(function () {
				Route::get('/', 'ListKasirController@index')->name('index');
				Route::get('create', 'ListKasirController@create')->name('create');
				Route::post('create', 'ListKasirController@store')->name('store');
				Route::get('{data:uuid}/edit', 'ListKasirController@edit')->name('edit');
				Route::match(['patch', 'put'], '{data:uuid}/update', 'ListKasirController@update')->name('update');
				Route::delete('{data:uuid}/delete', 'ListKasirController@destroy')->name('destroy');
			});
		});

		Route::namespace('Auth')->name('auth.')->group(function () {
			Route::get('pengaturan', 'SettingsController@edit')->name('settings');
			Route::patch('pengaturan', 'SettingsController@store');
			Route::patch('change-password', 'SettingsController@update')->name('settings.password');
		});

		Route::namespace('MasterData')->prefix('master-data')->name('master-data.')->group(function () {

			Route::prefix('banner-ecommerce')->name('banner.')->group(function () {
				Route::get('/', 'BannerController@index')->name('index');
				Route::get('create', 'BannerController@create')->name('create');
				Route::post('create', 'BannerController@store')->name('store');
				Route::get('{data:uuid}/edit', 'BannerController@edit')->name('edit');
				Route::patch('{data:uuid}/edit', 'BannerController@update')->name('update');
				Route::delete('{data:uuid}/delete', 'BannerController@destroy')->name('destroy');
			});

			Route::prefix('kategori-barang')->name('kategori-barang.')->group(function () {
				Route::get('/', 'KategoriBarangController@index')->name('index');
				Route::get('create', 'KategoriBarangController@create')->name('create');
				Route::post('create', 'KategoriBarangController@store')->name('store');
				Route::get('{data:uuid}/edit', 'KategoriBarangController@edit')->name('edit');
				Route::patch('{data:uuid}/edit', 'KategoriBarangController@update')->name('update');
				Route::delete('{data:uuid}/delete', 'KategoriBarangController@destroy')->name('destroy');
			});

			Route::prefix('kategori-umkm')->name('kategori-umkm.')->group(function () {
				Route::get('/', 'KategoriUMKMController@index')->name('index');
				Route::get('create', 'KategoriUMKMController@create')->name('create');
				Route::post('create', 'KategoriUMKMController@store')->name('store');
				Route::get('{data:uuid}/edit', 'KategoriUMKMController@edit')->name('edit');
				Route::patch('{data:uuid}/edit', 'KategoriUMKMController@update')->name('update');
				Route::delete('{data:uuid}/delete', 'KategoriUMKMController@destroy')->name('destroy');
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
			Route::post('export', 'UMKMController@export')->name('export');
			Route::post('{uuid}/show/export', 'UMKMController@export')->name('export.show');
		});

		Route::namespace('Barang')->prefix('barang')->name('barang.')->group(function () {
			Route::get('/', 'BarangController@index')->name('index');
			Route::get('create', 'BarangController@create')->name('create');
			Route::post('create', 'BarangController@store')->name('store');
			Route::get('{data:uuid}/edit', 'BarangController@edit')->name('edit');
			Route::patch('{data:uuid}/edit', 'BarangController@update')->name('update');
			Route::delete('{data:uuid}/delete', 'BarangController@destroy')->name('destroy');
			Route::post('export', 'BarangController@export')->name('export');
			Route::get('{data:uuid}/send-whatsapp', 'BarangController@sendWhatsapp')->name('send-whatsapp');

			Route::prefix('{data:uuid}/foto')->name('foto.')->group(function () {
				Route::get('/', 'FotoController@index')->name('index');
				Route::get('create', 'FotoController@create')->name('create');
				Route::post('create', 'FotoController@store')->name('store');
				Route::get('{uuid}/edit', 'FotoController@edit')->name('edit');
				Route::patch('{uuid}/edit', 'FotoController@update')->name('update');
				Route::delete('{uuid}/delete', 'FotoController@destroy')->name('destroy');
			});

			Route::prefix('log')->name('log.')->group(function () {
				Route::get('/', 'LogController@index')->name('index');
				Route::get('{data:uuid}/show', 'LogController@show')->name('show');
			});
		});
	});
});
