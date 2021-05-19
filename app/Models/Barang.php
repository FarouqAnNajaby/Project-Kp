<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Carbon\Carbon;
use App\Observers\Admin\BarangObserver;

class Barang extends Model
{
	use HasFactory, Uuid, SoftDeletes;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'barang';

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
	 * Get the barang created_at.
	 *
	 * @return string
	 */
	public function getTanggalInputAttribute()
	{
		return Carbon::parse($this->created_at)->isoFormat('dddd, Do MMMM YYYY');
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
	 * Get the limitted nama barang text.
	 *
	 * @return string
	 */
	public function getNameLimittedAttribute()
	{
		return Str::limit($this->nama, 20, '<p class="d-inline-block" data-toggle="tooltip" title="' . $this->nama . '">...</p>');
	}

	/**
	 * Get the limitted umkm text.
	 *
	 * @return string
	 */
	public function getUmkmLimittedAttribute()
	{
		return Str::limit($this->UMKM->nama, 20, '<p class="d-inline-block" data-toggle="tooltip" title="' . $this->UMKM->nama . '">...</p>');
	}

	/**
	 * Get the limitted nama barang text for ecommerce.
	 *
	 * @return string
	 */
	public function getNameLimitted2Attribute()
	{
		return Str::limit($this->nama, 30, '<p class="d-inline-block" data-toggle="tooltip" title="' . $this->nama . '">...</p>');
	}

	/**
	 * Get the highlight foto.
	 *
	 * @return string
	 */
	public function getFotoHighlightAttribute()
	{
		// return $this->select('barang_foto.file');
	}

	/**
	 * Get the log barang for barang
	 */
	public function Log()
	{
		return $this->hasMany(BarangLog::class, 'uuid_barang', 'uuid');
	}

	/**
	 * Get the log barang for barang
	 */
	public function UMKM()
	{
		return $this->belongsTo(UMKM::class, 'uuid_umkm', 'uuid')->withTrashed();
	}

	/**
	 * Get the log barang for barang
	 */
	public function Kategori()
	{
		return $this->belongsTo(BarangKategori::class, 'uuid_barang_kategori', 'uuid');
	}

	/**
	 * Get the foto barang for barang
	 */
	public function Foto()
	{
		return $this->hasMany(BarangFoto::class, 'uuid_barang', 'uuid');
	}

	/**
	 * Get the foto barang for barang
	 */
	public function Transaksi()
	{
		return $this->hasMany(TransaksiBarang::class, 'uuid_barang', 'uuid');
	}

	/**
	 * Get the foto barang for barang
	 */
	public function Review()
	{
		return $this->hasMany(Review::class, 'uuid_barang', 'uuid');
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

		Barang::observe(BarangObserver::class);

		static::creating(function ($model) {
			$model->kode = Str::upper(Str::random(10));
		});
	}
}
