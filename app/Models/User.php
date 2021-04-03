<?php

namespace App\Models;

use Propaganistas\LaravelPhone\PhoneNumber;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class User extends Authenticatable
{
	use Uuid, HasFactory, Notifiable;

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
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

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
	 *  Get the formatted nomor telepon.
	 *
	 * @return string
	 */
	public function getFormattedNotelpAttribute()
	{
		return PhoneNumber::make($this->nomor_telepon)->formatNational();
	}

	/**
	 * Get the transaksi
	 */
	public function Transaksi()
	{
		return $this->hasMany(Transaksi::class, 'uuid_user', 'uuid');
	}
}
