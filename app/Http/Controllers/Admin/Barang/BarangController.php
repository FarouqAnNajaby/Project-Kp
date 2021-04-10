<?php

namespace App\Http\Controllers\Admin\Barang;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\UMKM;
use App\Models\BarangKategori;
use App\Models\Barang;
use App\Http\Requests\Admin\BarangRequest;
use App\Http\Controllers\Controller;
use App\Exports\Admin\Barang\BarangExport;
use App\DataTables\Admin\Barang\ListBarangDataTable;

class BarangController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(ListBarangDataTable $dataTable)
	{
		$outOfStock = Barang::where('stok', '<=', 10)
			->whereHas('umkm', function (Builder $query) {
				$query->whereNull('deleted_at');
			})
			->orderBy('stok', 'ASC')->paginate(5);
		$kategori = BarangKategori::pluck('nama', 'uuid');
		return $dataTable->render('admin.app.barang.index', compact('kategori', 'outOfStock'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$umkm     = UMKM::pluck('nama', 'uuid');
		$kategori = BarangKategori::pluck('nama', 'uuid');
		return view('admin.app.barang.create', compact('umkm', 'kategori'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(BarangRequest $request)
	{
		$validated = $request->validated();
		$validated = Arr::except($validated, ['harga', 'stok', 'umkm', 'kategori', 'deskripsi', 'deskripsi_singkat']);

		$harga             = filter_var($request->harga, FILTER_SANITIZE_NUMBER_INT);
		$stok              = filter_var($request->stok, FILTER_SANITIZE_NUMBER_INT);
		$deskripsi         = nl2br(strip_tags($request->deskripsi));
		$deskripsi_singkat = strip_tags($request->deskripsi_singkat);
		$slug              = Str::slug($request->nama);

		$validated = Arr::add($validated, 'uuid_umkm', $request->umkm);
		$validated = Arr::add($validated, 'uuid_barang_kategori', $request->kategori);
		$validated = Arr::add($validated, 'harga', $harga);
		$validated = Arr::add($validated, 'stok', $stok);
		$validated = Arr::add($validated, 'deskripsi', $deskripsi);
		$validated = Arr::add($validated, 'deskripsi_singkat', $deskripsi_singkat);
		$validated = Arr::add($validated, 'slug', $slug);

		Barang::create($validated);

		alert()
			->success('Data berhasil ditambahkan', 'Sukses!')
			->persistent('Tutup')
			->autoclose(3000);

		return redirect()->route('admin.barang.create');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show()
	{
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Barang $data)
	{
		$kategori = BarangKategori::pluck('nama', 'uuid');
		return view('admin.app.barang.edit', compact('data', 'kategori'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(BarangRequest $request, Barang $data)
	{
		$validated = $request->validated();
		$validated = Arr::except($validated, ['harga', 'stok', 'kategori', 'deskripsi', 'deskripsi_singkat']);

		$harga             = filter_var($request->harga, FILTER_SANITIZE_NUMBER_INT);
		$stok              = filter_var($request->stok, FILTER_SANITIZE_NUMBER_INT);
		$deskripsi         = nl2br(strip_tags($request->deskripsi));
		$deskripsi_singkat = strip_tags($request->deskripsi_singkat);
		$slug              = Str::slug($request->nama);

		$validated = Arr::add($validated, 'uuid_barang_kategori', $request->kategori);
		$validated = Arr::add($validated, 'harga', $harga);
		$validated = Arr::add($validated, 'stok', $stok);
		$validated = Arr::add($validated, 'deskripsi', $deskripsi);
		$validated = Arr::add($validated, 'deskripsi_singkat', $deskripsi_singkat);
		$validated = Arr::add($validated, 'slug', $slug);

		$stok_awal = $data->stok;
		$harga_awal = $data->harga;

		$data->update($validated);
		if ($stok != $stok_awal || $harga != $harga_awal) {
			$data->log()->create([
				'stok'  => $stok,
				'harga' => $harga
			]);
		}

		alert()
			->success('Data berhasil diubah', 'Sukses!')
			->persistent('Tutup')
			->autoclose(3000);

		return redirect()->route('admin.barang.edit', $data->uuid);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  string  $data
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Barang $data)
	{
		$data->delete();
		alert()
			->success('Data berhasil dihapus', 'Sukses!')
			->persistent('Tutup')
			->autoclose(3000);

		return redirect()->route('admin.barang.index');
	}

	public function export(Request $request)
	{
		$search = $request->search['value'];
		$kategori = $request->kategori;
		if ($request->action == 'csv') {
			$ext = '.csv';
		} else {
			$ext = '.xlsx';
		}
		$export = new BarangExport($search, $kategori);
		return Excel::download($export, 'Daftar Barang-' . date('Ymdhis') . $ext);
	}

	public function sendWhatsapp(Barang $data)
	{
		$text = 'Kepada%20' . $data->UMKM->nama . '%20yang%20bersangkutan%2C%20kami%20dari%20lamonganmart.com%20mengkonfirmasi%20bahwa%20jumlah%20stok%20produk%20' . $data->nama . '%20anda%20telah%20menipis.%20Harap%20datang%20satu%20hari%20setelah%20informasi%20ini%20diberikan%20ke%20Lamongan%20Mart%20di%20Jl.%20Basuki%20Rahmat%20No.176%2C%20Groyok%2C%20Sukomulyo%2C%20Lamongan%20untuk%20membawa%20stok%20produk%20' . $data->nama . '.%20Terima%20kasih%20atas%20perhatianya.%0A%0ALamongan%20Mart%20buka%0AHari%20%3A%20Senin%20s%2Fd%20Jumat%0APukul%20%3A%2008.00%20-%2015.00%0A%0ASalam%20%2C%20Admin';
		return redirect()->away('whatsapp://send?phone=' . $data->UMKM->nomor_telp . '&text=' . $text);
	}
}
