<?php

namespace App\Observers\Admin;

use App\Models\Barang;

class BarangObserver
{
	/**
	 * Handle the Barang "created" event.
	 *
	 * @param  \App\Models\Barang  $barang
	 * @return void
	 */
	public function created(Barang $barang)
	{
		$barang->log()->create([
			'stok'  => $barang->stok,
			'harga' => $barang->harga
		]);
	}

	/**
	 * Handle the Barang "updated" event.
	 *
	 * @param  \App\Models\Barang  $barang
	 * @return void
	 */
	public function updated(Barang $barang)
	{
		//
	}

	/**
	 * Handle the Barang "deleted" event.
	 *
	 * @param  \App\Models\Barang  $barang
	 * @return void
	 */
	public function deleted(Barang $barang)
	{
		//
	}

	/**
	 * Handle the Barang "restored" event.
	 *
	 * @param  \App\Models\Barang  $barang
	 * @return void
	 */
	public function restored(Barang $barang)
	{
		//
	}

	/**
	 * Handle the Barang "force deleted" event.
	 *
	 * @param  \App\Models\Barang  $barang
	 * @return void
	 */
	public function forceDeleted(Barang $barang)
	{
		//
	}
}
