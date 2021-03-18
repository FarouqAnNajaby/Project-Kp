<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Transaksi extends Model
{
	use HasFactory, Uuid;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'transaksi';

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
	 * Get the transaksi date.
	 *
	 * @return string
	 */
	public function getFormattedTanggalAttribute()
	{
		return $this->created_at->isoFormat('dddd, Do MMMM YYYY');
	}

	/**
	 * Get the total in rupiah format
	 *
	 * @return string
	 */
	public function getRpTotalAttribute()
	{
		return 'Rp' . number_format($this->total, 2, ',', '.');
	}

	/**
	 * Get the user
	 */
	public function User()
	{
		return $this->belongsTo(User::class, 'uuid_user', 'uuid');
	}

	/**
	 * Get the daftar barang for related transaksi
	 */
	public function TransaksiBarang()
	{
		return $this->hasMany(TransaksiBarang::class, 'uuid_transaksi', 'uuid');
	}
}
