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

    Route::prefix('umkm')->group(function () {

        Route::get('/', 'UMKMController@index')->name('admin.umkm.index');

        Route::get('create', 'UMKMController@create')->name('admin.umkm.create');
    });
});

Route::namespace('Kasir')->prefix('kasir')->group(function () {

    Route::get('/', 'HomeController@index')->name('kasir.index');
});



// require __DIR__ . '/auth.php';
