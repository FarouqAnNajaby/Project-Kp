<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Carbon\Carbon;

class BarangLog extends Model
{
	use HasFactory, Uuid;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'barang_log';

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
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

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
	 * Get the barang harga.
	 *
	 * @return string
	 */
	public function getRpHargaAttribute()
	{
		return 'Rp' . number_format($this->harga, 2, ',', '.');
	}

	/**
	 * Get the barang stok awal.
	 *
	 * @return string
	 */
	public function getStokFormattedAttribute()
	{
		return number_format($this->stok, 0, '', '.');
	}

	/**
	 * Get the barang created_at.
	 *
	 * @return string
	 */
	public function getTanggalInputAttribute()
	{
		return Carbon::parse($this->created_at)->isoFormat('dddd, Do MMMM YYYY');
	}

	/**
	 * Get the related barang.
	 */
	public function Barang()
	{
		return $this->belongsTo(Barang::class, 'uuid_barang', 'uuid')->withTrashed();
	}

	/**
	 * Get the creator admin for log barang
	 */
	public function Admin()
	{
		return $this->belongsTo(Admin::class, 'admin_uuid', 'uuid');
	}

	/**
	 * The "booted" method of the model.
	 *
	 * @return void
	 */
	protected static function booted()
	{
		parent::boot();

		static::creating(function ($model) {
			$model->created_at = $model->freshTimestamp();
		});
	}
}
