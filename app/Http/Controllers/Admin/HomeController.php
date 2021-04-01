<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use DateTimeZone;
use DateTime;
use DateInterval;
use App\Models\User;
use App\Models\UMKM;
use App\Models\Transaksi;
use App\Models\Barang;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
	public function index(Request $request)
	{
		$umkm_count = UMKM::count();
		$barang_count = Barang::count();
		$user_count = User::count();

		$start = new DateTime(date('Y-m-01'));
		$timezone = new DateTimeZone('Asia/Jakarta');
		$start->setTimezone($timezone);

		$month = $start->format('F');
		$tanggal = array();
		$i = 0;
		while ($start->format('F') == $month) {
			$tanggal[$i++] = strftime('%d %b', strtotime($start->format('d-m-Y')));
			$start->add(new DateInterval("P1D"));
		}

		$bulan_transaksi = $request->bulan_transaksi;
		$tahun_transaksi = $request->tahun_transaksi;
		$transaksi = Transaksi::when($bulan_transaksi, function ($query, $bulan_transaksi) {
			return $query->whereMonth('created_at', $bulan_transaksi);
		}, function ($query) {
			return $query->whereMonth('created_at', now());
		})
			->when($tahun_transaksi, function ($query, $tahun_transaksi) {
				return $query->whereYear('created_at', $tahun_transaksi);
			}, function ($query) {
				return $query->whereYear('created_at', now());
			})
			->selectRaw("COUNT(*) total")
			->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"))
			->pluck('total');

		$bulan_umkm = $request->bulan_umkm;
		$tahun_umkm = $request->tahun_umkm;
		$umkm = UMKM::when($bulan_umkm, function ($query, $bulan_umkm) {
			return $query->whereMonth('created_at', $bulan_umkm);
		}, function ($query) {
			return $query->whereMonth('created_at', now());
		})
			->when($tahun_umkm, function ($query, $tahun_umkm) {
				return $query->whereYear('created_at', $tahun_umkm);
			}, function ($query) {
				return $query->whereYear('created_at', now());
			})
			->selectRaw("COUNT(*) total")
			->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"))
			->pluck('total');

		$tanggal_transaksi = implode("', '", $tanggal);
		if ($bulan_transaksi) {
			$month = explode(' ', $tanggal[0])[1];
			$tgl = new DateTime(date("Y-$bulan_transaksi-01"));
			$bln = strftime('%b', $tgl->getTimestamp());
			$tanggal_transaksi = str_replace($month, $bln, $tanggal_transaksi);
		}

		$tanggal_umkm = implode("', '", $tanggal);
		if ($bulan_umkm) {
			$month = explode(' ', $tanggal[0])[1];
			$tgl = new DateTime(date("Y-$bulan_umkm-01"));
			$bln = strftime('%b', $tgl->getTimestamp());
			$tanggal_umkm = str_replace($month, $bln, $tanggal_umkm);
		}

		$bulan = [
			'01' => 'Januari',
			'02' => 'Februari',
			'03' => 'Maret',
			'04' => 'April',
			'05' => 'Mei',
			'06' => 'Juni',
			'07' => 'Juli',
			'08' => 'Agustus',
			'09' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember'
		];
		$tahun = [];
		for ($i = date('Y'); $i > date('Y') - 21; $i--) {
			$tahun[$i] = $i;
		};
		return view('admin.app.index')->with([
			'bulan' => $bulan,
			'tahun' => $tahun,
			'user_count' => $user_count,
			'barang_count' => $barang_count,
			'umkm_count' => $umkm_count,
			'transaksi' => $transaksi,
			'umkm' => $umkm,
			'tanggal_transaksi' => $tanggal_transaksi,
			'tanggal_umkm' => $tanggal_umkm
		]);
	}
}
