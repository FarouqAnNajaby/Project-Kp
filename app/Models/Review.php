<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Carbon\Carbon;

class Review extends Model
{
	use HasFactory, Uuid;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'review';

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
	 * Get the transaksi date ecommerce.
	 *
	 * @return string
	 */
	public function getFormattedTanggalAttribute()
	{
		return Carbon::parse($this->updated_at)->isoFormat('dddd, Do MMMM YYYY - HH:mm:ss');
	}

	/**
	 * Get the related barang
	 */
	public function Barang()
	{
		return $this->belongsTo(Barang::class, 'uuid_barang', 'uuid');
	}

	/**
	 * Get the related barang
	 */
	public function User()
	{
		return $this->belongsTo(User::class, 'uuid_user', 'uuid');
	}
}
