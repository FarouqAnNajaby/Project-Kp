<!DOCTYPE html>
<html lang="en">

<head>
    <title>Print Table</title>
    <meta charset="UTF-8">
    <meta name=description content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/admin/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/fontawesome/css/all.min.css') }}">
    <style>
        body {
            margin: 20px
        }
    </style>
</head>

<body>
    <table class="table table-bordered table-condensed table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Jumlah Transaksi</th>
            </tr>
        </thead>
        @php
        $uuid = request()->segment(3);
        $search = request()->search['value'];
        $kategori = request()->kategori;
        $col = request()->columns;
        $direction = request()->order;
        $data = \App\Models\Barang::select('barang.*')->where('uuid_umkm', $uuid);
        if($search) {
        $data = $data->where(function($query) use($search) {
        $query->orWhere('barang.kode', 'LIKE', "%$search%")
        ->orWhere('barang.nama', 'LIKE', "%$search%")
        ->orWhere('barang.stok', $search)
        ->orWhere(function($query) use($search) {
        $search = preg_replace("/[^0-9,]/", "", $search);
        if (strpos($search, ',')) {
        $search = trim($search, 0);
        }
        $search = filter_var($search, FILTER_SANITIZE_NUMBER_INT);
        if (filter_var($search, FILTER_VALIDATE_INT)) {
        $query->orWhere('barang.harga', 'LIKE', "%$search%");
        }
        })
        ->orWhere(function($transaksi) use($search) {
        $search = filter_var($search, FILTER_SANITIZE_NUMBER_INT);
        if (filter_var($search, FILTER_VALIDATE_INT)) {
        $transaksi->whereHas('transaksi', function (Builder $q) use ($search) {
        $q->select(DB::raw('sum(jumlah)'))
        ->havingRaw('sum(jumlah) = ?', [$search]);
        });
        }
        });
        });
        }
        if($kategori) {
        $data = $data->where('barang.uuid_barang_kategori', $kategori);
        }

        foreach ($direction as $key => $value) {
        foreach($col as $index => $val) {
        if($value['column'] == $index) {
        $dir = $direction[$key]['dir'];
        if($col[$index]['name'] == 'kategori.nama') {
        $data = $data->with(['kategori' => function($query) use($dir) {
        $query->orderBy('nama', $dir);
        }]);
        } else if($col[$index]['name'] == 'transaksi') {
        $data = $data->join('transaksi_barang', 'transaksi_barang.uuid_barang', '=', 'barang.uuid')
        ->groupBy('uuid_barang')->orderByRaw('SUM(jumlah) ' . $dir);
        } else {
        $data = $data->orderBy($col[$index]['name'], $dir);
        }
        }
        }
        }
        $data = $data->get();
        @endphp
        @foreach($data as $row)
        <tr>
            <td class="text-center">
                {{ $loop->iteration }}.
            </td>
            <td>{{ $row->kode }}</td>
            <td>{{ $row->nama }}</td>
            <td>{{ $row->Kategori->nama }}</td>
            <td>{{ number_format($row->stok, 0, '', '.') }}</td>
            <td>{{ 'Rp' . number_format($row->harga, 2, ',', '.') }}</td>
            <td>{{ number_format($row->Transaksi()->sum('jumlah'), 0, '', '.') }}</td>
        </tr>
        @endforeach
    </table>
    <script>
        window.print();
    </script>
</body>

</html>