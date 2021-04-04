<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Carbon\Carbon;

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
	 * Get the transaksi date.
	 *
	 * @return string
	 */
	public function getFormattedTanggalAttribute()
	{
		return Carbon::parse($this->created_at)->isoFormat('dddd, Do MMMM YYYY');
	}

	/**
	 * Get the transaksi date ecommerce.
	 *
	 * @return string
	 */
	public function getFormattedTanggalEcommerceAttribute()
	{
		return Carbon::parse($this->created_at)->isoFormat('dddd, Do MMMM YYYY - HH:mm:s');
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

	/**
	 * The "booted" method of the model.
	 *
	 * @return void
	 */
	protected static function booted()
	{
		parent::boot();

		static::creating(function ($model) {
			$model->kode = Str::upper(Str::random(10));
			$model->created_at = $model->freshTimestamp();
		});
	}
}
