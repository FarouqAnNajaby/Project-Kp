<?php

namespace App\Http\Controllers\Kasir;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\BarangKategori;
use App\Models\Barang;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
	public function index()
	{
		$kategori = BarangKategori::whereHas('barang', function (Builder $query) {
			$query->has('foto');
		})
			->pluck('nama', 'uuid');
		return view('kasir.app.kasir.index', compact('kategori'));
	}
}
