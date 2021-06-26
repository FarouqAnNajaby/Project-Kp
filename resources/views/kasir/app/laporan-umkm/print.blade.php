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
    $uuid = request()->segment(3);
    $search = request()->search['value'];
    $kategori = request()->kategori;
    $col = request()->columns;
    $direction = request()->order;
    $data = \App\Models\Barang::select('barang.*')->where('uuid_umkm', $uuid);
    if($search) {$data = $data
    ->where(function ($query) use ($keyword) {
    $query
    ->orWhere('nama', 'LIKE', "%$keyword%")
    ->orWhere('kode', 'LIKE', "%$keyword%")
    ->orWhere(function ($q) use ($keyword) {
    $keyword = filter_var($keyword, FILTER_SANITIZE_NUMBER_INT);
    if (filter_var($keyword, FILTER_VALIDATE_INT)) {
    $q->whereHas('transaksi', function (Builder $qq) use ($keyword) {
    $qq->select(DB::raw('sum(jumlah)'))
    ->havingRaw('sum(jumlah) = ?', [$keyword]);
    });
    }
    })
    ->orWhere(function ($q) use ($keyword) {
    $keyword = preg_replace("/[^0-9,]/", "", $keyword);
    if (strpos($keyword, ',')) {
    $keyword = trim($keyword, 0);
    }
    $keyword = filter_var($keyword, FILTER_SANITIZE_NUMBER_INT);
    if (filter_var($keyword, FILTER_VALIDATE_INT)) {
    $q->whereHas('transaksi', function (Builder $qq) use ($keyword) {
    $qq->select(DB::raw('sum(jumlah*harga)'))
    ->havingRaw('sum(jumlah*harga) = ?', [$keyword]);
    });
    }
    });
    });
    }
    $data = $data->join('transaksi_barang', 'transaksi_barang.uuid_barang', '=', 'barang.uuid');
    foreach ($direction as $key => $value) {
    foreach($col as $index => $val) {
    if($value['column'] == $index) {
    $dir = $direction[$key]['dir'];
    if ($col[$index]['data'] == 'terjual') {
    $data = $data->groupBy('transaksi_barang.uuid_barang')->orderByRaw('SUM(jumlah) ' . $dir);
    } else if ($col[$index]['data'] == 'pendapatan') {
    $data = $data->groupBy('transaksi_barang.uuid_barang')->orderByRaw('SUM(transaksi_barang.jumlah*transaksi_barang.harga) ' . $dir);
    } else {
    $data = $data->orderBy($col[$index]['data'], $dir);
    }
    }
    }
    }
    $data = $data->get();
    $umkm = \App\Models\UMKM::where('uuid', $uuid)->first();
    @endphp
    <h4 class="text-center mb-4">DAFTAR BARANG - UMKM {{ strtoupper($umkm->nama) }}</h4>
    <table class="table table-bordered table-condensed table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Terjual</th>
                <th>Total Pendapatan</th>
            </tr>
        </thead>
        @foreach($data as $row)
        <tr>
            <td class="text-center">
                {{ $loop->iteration }}.
            </td>
            <td>{{ $row->kode }}</td>
            <td>{{ $row->nama }}</td>
            <td>{{ number_format($row->Transaksi()->sum('jumlah'), 0, '', '.') }}</td>
            <td>{{ 'Rp. ' . number_format($row->Transaksi()->sum(DB::raw('harga * jumlah')), 0, '', '.') }}</td>
        </tr>
        @endforeach
    </table>
    <script>
        window.print();
    </script>
</body>

</html>