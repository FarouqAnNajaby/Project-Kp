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
    $data = \App\Models\Barang::where('uuid_umkm', $uuid);
    if($search) {
    $data = $data->where(function($query) use($search) {
    $query->orWhere('kode', 'LIKE', "%$search%")
    ->orWhere('nama', 'LIKE', "%$search%")
    ->orWhere('stok', $search)
    ->orWhere(function($query) use($search) {
    $search = preg_replace("/[^0-9,]/", "", $search);
    if (strpos($search, ',')) {
    $search = trim($search, 0);
    }
    $search = filter_var($search, FILTER_SANITIZE_NUMBER_INT);
    if (filter_var($search, FILTER_VALIDATE_INT)) {
    $query->orWhere('harga', 'LIKE', "%$search%");
    }
    });
    });
    }
    if($kategori) {
    $data = $data->where('uuid_barang_kategori', $kategori);
    }

    $orderBy = [];
    foreach ($direction as $key => $value) {
    foreach($col as $index => $val) {
    if($value['column'] == $index) {
    $dir = $direction[$key]['dir'];
    if($col[$index]['name'] == 'kategori.nama') {
    $data = $data->with(['kategori' => function($query) use($dir) {
    $query->orderBy('nama', $dir);
    }]);
    } else {
    $data = $data->orderBy($col[$index]['name'], $dir);
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
                <th>Kategori</th>
                <th>Stok</th>
                <th>Harga</th>
            </tr>
        </thead>
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
        </tr>
        @endforeach
    </table>
    <script>
        window.print();
    </script>
</body>

</html>