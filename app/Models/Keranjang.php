<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Keranjang extends Model
{
	use HasFactory, Uuid;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'keranjang';

	/**
	 * The primary key associated with the table.
	 *
	 * @var string
	 */
	protected $primaryKey = 'uuid';

	/**
	 * The "type" of the auto-incrementing ID.
	 *
	 * @var string
	 */
	protected $keyType = 'string';

	/**
	 * Indicates if the IDs are auto-incrementing.
	 *
	 * @var bool
	 */
	public $incrementing = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [];

	/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName()
	{
		return 'uuid';
	}

	/**
	 * Get the subtotal.
	 *
	 * @return string
	 */
	public function getSubTotalAttribute()
	{
		$sub_total = $this->jumlah * $this->Barang->harga;
		return 'Rp' . number_format($sub_total, 2, ',', '.');
	}

	/**
	 * Get the user
	 */
	public function User()
	{
		return $this->belongsTo(User::class, 'uuid_user', 'uuid');
	}

	/**
	 * Get the barang
	 */
	public function Barang()
	{
		return $this->belongsTo(Barang::class, 'uuid_barang', 'uuid');
	}
}
