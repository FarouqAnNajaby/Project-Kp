<?php

namespace App\Models;

use Propaganistas\LaravelPhone\PhoneNumber;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use App\Models\UMKMKategori;

class UMKM extends Model
{
	use HasFactory, Uuid, SoftDeletes;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'umkm';

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
	 *  Get the UMKM created_at.
	 *
	 * @return string
	 */
	public function getTanggalInputAttribute()
	{
		return $this->created_at->isoFormat('dddd, Do MMMM YYYY');
	}

	/**
	 *  Get the UMKM created_at.
	 *
	 * @return string
	 */
	public function getLocalNomorTelpAttribute()
	{
		return PhoneNumber::make($this->nomor_telp, 'ID')->formatNational();
	}

	/**
	 * Get the list barang for umkm
	 */
	public function Barang()
	{
		return $this->hasMany(Barang::class, 'uuid_umkm', 'uuid');
	}

	/**
	 * Get the kategori umkm for umkm
	 */
	public function UMKM_Kategori()
	{
		return $this->belongsTo(UMKMKategori::class, 'uuid_umkm_kategori', 'uuid');
	}

	/**
	 * Get the creator admin for umkm
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
			$model->kode = Str::upper(Str::random(10));
		});
	}
}
