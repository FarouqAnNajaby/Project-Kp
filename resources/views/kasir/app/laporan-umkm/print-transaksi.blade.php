<!DOCTYPE html>
<html lang="en">

<head>
    <title>Print Table</title>
    <meta charset="UTF-8">
    <meta name=description content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">
    <style>
        body {
            margin: 20px
        }
    </style>
</head>

<body>
    @php
    $uuid = request()->segment(5);
    $search = request()->search['value'];
    $kategori = request()->kategori;
    $col = request()->columns;
    $direction = request()->order;
    $data = \App\Models\TransaksiBarang::where('uuid_barang', $uuid)->select('transaksi_barang.*');

    if($search) {
		$data = $data->where(function ($query) use ($keyword) {
			$query->orWhere(function ($q) use ($keyword) {
				$q->whereHas('transaksi', function (Builder $qq) use ($keyword) {
					$qqq->where('kode', 'LIKE', "%$keyword%");
				});
			})
			->orWhere(function ($q) use ($keyword) {
				$keyword = preg_replace("/[^0-9,]/", "", $keyword);
				if (strpos($keyword, ',')) {
					$keyword = trim($keyword, 0);
				}
				$keyword = filter_var($keyword, FILTER_SANITIZE_NUMBER_INT);
				if (filter_var($keyword, FILTER_VALIDATE_INT)) {
					$q->where('jumlah', 'LIKE', "%$keyword%");
				}
			})
			->orWhere(function ($q) use ($keyword) {
				$keyword = preg_replace("/[^0-9,]/", "", $keyword);
				if (strpos($keyword, ',')) {
					$keyword = trim($keyword, 0);
				}
				$keyword = filter_var($keyword, FILTER_SANITIZE_NUMBER_INT);
				if (filter_var($keyword, FILTER_VALIDATE_INT)) {
					$q->where(DB::raw('jumlah*harga'), 'LIKE', "%$keyword%");
				}
			})
			->orWhere(function ($q) use ($keyword) {
				$keyword = preg_replace("/[^0-9,]/", "", $keyword);
				if (strpos($keyword, ',')) {
					$keyword = trim($keyword, 0);
				}
				$keyword = filter_var($keyword, FILTER_SANITIZE_NUMBER_INT);
				if (filter_var($keyword, FILTER_VALIDATE_INT)) {
					$q->where('harga', 'LIKE', "%$keyword%");
				}
			});
		});
    }

    foreach ($direction as $key => $value) {
		foreach($col as $index => $val) {
			if($value['column'] == $index) {
				$dir = $direction[$key]['dir'];
				if($col[$index]['data'] == 'kode') {
					$data = $data->whereHas('transaksi', function (Builder $q) use ($dir) {
						$q->orderBy('kode', $dir);
					});
				} else if ($col[$index]['data'] == 'terjual') {
					$data = $data->orderBy('jumlah', $dir);
				} else if ($col[$index]['data'] == 'total') {
					$data = $data->groupBy('uuid_barang')->orderByRaw('transaksi_barang.jumlah*transaksi_barang.harga ' . $dir);
				} else {
					$data = $data->orderBy($col[$index]['data'], $dir);
				}
			}
		}
	}
    $data = $data->get();
    $barang = \App\Models\Barang::where('uuid', $uuid)->first();
    @endphp
    <h4 class="text-center mb-4">DAFTAR TRANSAKSI - {{ strtoupper($barang->nama) }}</h4>
    <table class="table table-bordered table-condensed table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Terjual</th>
                <th>Harga</th>
                <th>Total</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        @foreach($data as $row)
        <tr>
            <td class="text-center">
                {{ $loop->iteration }}.
            </td>
            <td>{{ $row->Transaksi->kode }}</td>
            <td>{{ number_format($row->jumlah, 0, '', '.') }}</td>
            <td>{{ 'Rp. ' . number_format($row->harga, 0, '', '.') }}</td>
            <td>{{ 'Rp. ' . number_format($row->jumlah*$row->harga, 0, '', '.') }}</td>
            <td>{{ \Carbon\Carbon::parse($row->created_at)->isoFormat('dddd, Do MMMM YYYY, hh:mm') }}</td>
        </tr>
        @endforeach
    </table>
    <script>
        window.print();
    </script>
</body>

</html>