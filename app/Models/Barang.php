<?php

namespace App\Models;

use Database\Factories\BarangFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory, Uuid;

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
    public function getStokAwalFormattedAttribute()
    {
        return number_format($this->stok_awal, 0, '', '.');
    }

    /**
     * Get the barang created_at.
     *
     * @return string
     */
    public function getTanggalInputAttribute()
    {
        return $this->created_at->isoFormat('dddd, Do MMMM YYYY');
    }

    /**
     * Get the history barang for barang
     */
    public function historyBarangs()
    {
        return $this->hasMany(HistoryBarang::class, 'uuid_barang', 'uuid');
    }
}
