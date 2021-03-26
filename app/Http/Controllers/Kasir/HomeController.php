<?php

namespace App\Http\Controllers\Kasir;

use Illuminate\Http\Request;
use App\Models\BarangKategori;
use App\Models\Barang;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
	public function index()
	{
		$kategori = BarangKategori::pluck('nama', 'uuid');
		return view('kasir.app.kasir.index', compact('kategori'));
	}
}
