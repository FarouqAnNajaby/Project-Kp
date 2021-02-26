<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
	public function index()
	{
		$bulan = [
			'jan' => 'Januari',
			'feb' => 'Februari',
			'mar' => 'Maret',
			'apr' => 'April',
			'mei' => 'Mei',
			'jun' => 'Juni',
			'jul' => 'Juli',
			'agu' => 'Agustus',
			'sep' => 'September',
			'okt' => 'Oktober',
			'nov' => 'November',
			'des' => 'Desember'
		];
		$tahun = [];
		$x = 0;
		for ($i = date('Y'); $i > date('Y') - 21; $i--) {
			$tahun[$x++] = $i;
		};
		return view('admin.app.index', compact('bulan', 'tahun'));
	}
}
