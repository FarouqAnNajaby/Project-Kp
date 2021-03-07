<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class TransaksiBarang extends Model
{
    use HasFactory, Uuid;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transaksi_barang';

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
    public function getRpHargaAttribute()
    {
        return 'Rp' . number_format($this->harga, 2, ',', '.');
    }

    /**
     * Get the barang created_at.
     *
     * @return string
     */
    public function getTotalAttribute()
    {
        $total = $this->harga * $this->jumlah;
        return 'Rp' . number_format($total, 2, ',', '.');
    }

    /**
     * Get the history barang for barang
     */
    public function Barang()
    {
        return $this->belongsTo(Barang::class, 'uuid_barang', 'uuid');
    }
}
