<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
     * Get the barang created_at.
     *
     * @return string
     */
    public function getFormattedTanggalAttribute()
    {
        return $this->created_at->isoFormat('dddd, Do MMMM YYYY');
    }

    /**
     * Get the barang created_at.
     *
     * @return string
     */
    public function getRpTotalAttribute()
    {
        return 'Rp' . number_format($this->total, 2, ',', '.');
    }

    /**
     * Get the history barang for barang
     */
    public function User()
    {
        return $this->belongsTo(User::class, 'uuid_user', 'uuid');
    }
}
